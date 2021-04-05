<?php

namespace App\Http\Controllers;

use App\PruebaComplementaria;
use Illuminate\Http\Request;

class PruebaComplementariaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($exam_id)
    {
        return view('prueba_complementarias.create',['exam_id'=>$exam_id]);
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
            'fichero' => ['required', 'string', 'max:255'],
            'comentario' => ['nullable', 'string', 'max:255'],
            'exam_id' => ['required', 'exists:exams,id']

        ]);

        $prueba_complementaria=new PruebaComplementaria($request->all());
        $prueba_complementaria->save();

        flash('Tipo creado correctamente');

        return redirect()->route('exams.show',$request->exam_id);
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
        $tipo_diagnostico = TipoDiagnostico::find($id);
        return view('tipo_diagnosticos.edit',['tipo_diagnostico'=> $tipo_diagnostico]);
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
            'name' => ['required', 'string', 'max:255'],

        ]);

        $tipo_diagnostico = TipoDiagnostico::find($id);
        $tipo_diagnostico->fill($request->all());
        $tipo_diagnostico->save();

        flash('Tipo creado correctamente');

        return redirect()->route('tipo_diagnosticos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_diagnostico = TipoDiagnostico::find($id);
        $tipo_diagnostico->delete();
        flash('Tipo borrado correctamente');

        return redirect()->route('tipo_diagnosticos.index');
    }
}
