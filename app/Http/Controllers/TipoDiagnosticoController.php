<?php

namespace App\Http\Controllers;

use App\Diagnostico;
use App\Diente;
use App\TipoDiagnostico;
use Illuminate\Http\Request;

class TipoDiagnosticoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_diagnosticos=TipoDiagnostico::all();
        return view('tipo_diagnosticos.index',['tipo_diagnosticos'=>$tipo_diagnosticos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_diagnosticos = Diagnostico::all()->pluck('name','id');

        return view('tipo_diagnosticos.create',['tipo_diagnosticos'=>$tipo_diagnosticos]);
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
        ]);

        $tipo_diagnosticos=new TipoDiagnostico($request->all());
        $tipo_diagnosticos->save();

        flash('Tipo creado correctamente');

        return redirect()->route('tipo_diagnosticos.index');
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
