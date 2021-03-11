<?php

namespace App\Http\Controllers;

use App\Diagnostico;
use App\Diente;
use App\TipoDiagnostico;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosticos=Diagnostico::all();
        return view('diagnosticos.index',['diagnosticos'=>$diagnosticos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_diagnosticos=TipoDiagnostico::all()->pluck('name','id');

        return view('diagnosticos.create',['tipo_diagnosticos'=>$tipo_diagnosticos]);
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
            'tipo_id' => ['required', 'exists:tipo_diagnosticos,id'],
        ]);

        $diagnosticos=new Diagnostico($request->all());
        $diagnosticos->save();

        flash('Diagnostico creado correctamente');

        return redirect()->route('diagnosticos.index');
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
