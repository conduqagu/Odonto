<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=Patient::where('user_id', Auth::user()->id)->get();
        return view('patients.index',['patients'=>$patients]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
