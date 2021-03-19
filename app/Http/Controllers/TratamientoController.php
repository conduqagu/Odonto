<?php

namespace App\Http\Controllers;

use App\Braket;
use App\Diagnostico;
use App\Diente;
use App\TipoDiagnostico;
use App\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamientos=Tratamiento::all();
        return view('tratamientos/index',['tratamientos'=>$tratamientos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brakets=Braket::all()->pluck('name','id');
        return view('tratamientos/create',['brakets'=>$brakets]);
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
            'nombre' => ['required', 'string', 'max:255'],
            'realizado' => ['required', 'boolean'],
            'coste' => ['required', 'integer', 'max:255'],
            'iva' => ['required', 'integer', 'max:255'],
            'terapia' => ['required', 'string', 'in:sin definir,convencional,fases'],
            'duracionEstimada' => ['nullable', 'string', 'max:255'],
            'brakets_id' => ['required', 'exists:brakets,id'],
        ]);

        $tratamientos=new Tratamiento($request->all());
        $tratamientos->save();

        flash('Tratamiento creado correctamente');

        return redirect()->route('tratamientos.index');
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
     * Edit Student
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnostico = Diagnostico::find($id);
        return view('diagnosticos.edit',['diagnostico'=> $diagnostico]);
    }

    /**
     * Update Student
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => ['required', 'string', 'max:255'],
            'tipo_id' => ['required', 'exists:tipo_diagnosticos,id'],
        ]);

        $diagnostico = Diagnostico::find($id);
        $diagnostico->fill($request->all());
        $diagnostico->save();

        flash('Diagnóstico creado correctamente');

        return redirect()->route('diagnosticos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnostico = Diagnostico::find($id);
        $diagnostico->delete();
        flash('Diagnostico borrado correctamente');

        return redirect()->route('diagnosticos.index');
    }
}
