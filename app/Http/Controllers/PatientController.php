<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients=Patient::where('user_id', Auth::user()->id)->get();
        return view('patients.index',['patients'=>$patients]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string','min:9', 'unique:dni', 'unique:patients'],
            'email' => ['string', 'email', 'max:255', 'unique:patients'],
            'telefono' => ['string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required', 'riesgoASA', 'in: I,II,III,IV,V,VI'],
            'observaciones' => ['string', 'max:255'],

        ]);
    }

    /**
     * Create a new patient instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Patient
     */
    protected function create(array $data)
    {
        return Patient::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'dni'=>$data['dni'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'fechaNacimiento'=>$data['fechaNacimiento'],
            'riesgoASA'=>$data['riesgoASA'],
            'observaciones'=>$data['riesgoASA']
        ]);
    }
}
