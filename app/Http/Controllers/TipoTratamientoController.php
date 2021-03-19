<?php

namespace App\Http\Controllers;

use App\Braket;
use App\Diagnostico;
use App\Diente;
use App\TipoDiagnostico;
use App\TipoTratamiento;
use App\Tratamiento;
use Illuminate\Http\Request;

class TipoTratamientoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_tratamientos=TipoTratamiento::all();
        return view('tipo_tratamientos/index',['tipo_tratamientos'=>$tipo_tratamientos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('tipo_tratamientos/create');
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

        $tipo_tratamientos=new TipoTratamiento($request->all());
        $tipo_tratamientos->save();

        flash('Tipo de tratamiento creado correctamente');

        return redirect()->route('tipo_tratamientos.index');
    }

}
