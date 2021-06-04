<?php

namespace App\Mail;

use App\Exam;
use App\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoPago extends Mailable
{
    use Queueable, SerializesModels;

    public $exam;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $patient=Patient::find($this->exam->patient_id);
        $tratamientos=$this->exam->tratamientos()->get();
        $coste_total=0;
        foreach ($tratamientos as $tratamiento) {
            $coste_total = $tratamiento->coste + $coste_total;
        }
        return $this->view('mail.correo_pago',['patient'=>$patient,'exam'=>$this->exam,
            'tratamientos'=>$tratamientos,'coste_total'=>$coste_total]);
    }
}
