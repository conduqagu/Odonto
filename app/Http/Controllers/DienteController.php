<?php

namespace App\Http\Controllers;

use App\Diente;
use App\Patient;
use Illuminate\Http\Request;

class DienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dientes=Diente::all();
        return view('dientes.index',['dientes'=>$dientes]);
    }

    /**
     * Create a new diente instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Diente
     */
    public function create()
    {
        $patients = Patient::all()->pluck('name','id');
        return view('dientes.create',['patients'=>$patients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'max:100'],
            'cuadrante' => ['required', 'integer','max:4' ],
            'sextante' => ['required', 'integer','max:6' ],
            'patient_id'=>['required','exists:patients,id']
            ]);

        $diente=new Diente($request->all());
        $diente->save();

        flash('Diente creado correctamente');

        return redirect()->route('dientes.index');
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
        $diente = Diente::find($id);

        $patients = Patient::all()->pluck('name','id');

        return view('dientes.edit',['diente'=> $diente, 'patients'=>$patients ]);
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'max:100'],
            'cuadrante' => ['required', 'integer','max:4' ],
            'sextante' => ['required', 'integer','max:6' ],
            'patient_id'=>['required','exists:patients,id']
        ]);

        $diente = Diente::find($id);
        $diente->fill($request->all());

        $diente->save();

        flash('Diente modificado correctamente');

        return redirect()->route('dientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diente = Diente::find($id);
        $diente->delete();
        flash('Diente borrado correctamente');

        return redirect()->route('dientes.index');
    }
}
