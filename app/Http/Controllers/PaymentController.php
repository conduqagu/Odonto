<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    // ...

    public function payWithPayPal($exam_id)
    {
        $exam=Exam::find($exam_id);
        $coste_total=0;
        $tratamientos=$exam->tratamientos()->get();
        foreach ($tratamientos as $tratamiento) {
            $coste_total = $tratamiento->coste + $coste_total;
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($coste_total);
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Pago por examen del '.$exam->date);

        $callbackUrl = url('/paypal/status',$exam_id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request,$exam_id)
    {

        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');


        if (!$paymentId || !$payerId || !$token) {
            flash('Lo sentimos! El pago a través de PayPal no se pudo realizar.');
            return redirect()->route('pago_error');
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            flash('Gracias! El pago a través de PayPal se ha ralizado correctamente.');
            $exam=Exam::find($exam_id);
            $exam->cobrado=true;
            $exam->save();
            return redirect()->route('pago_correcto');
        }

        flash('Lo sentimos! El pago a través de PayPal no se pudo realizar.');
        return redirect()->route('pago_error');
    }

    public function pago_error(){
        return view('paypal/error');
    }
    public function pago_correcto(){
        return view('paypal/correcto');
    }
}
