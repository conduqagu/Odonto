<?php

namespace App\Http\Controllers;

use App\Braket;
use App\TipoTratamiento;
use Illuminate\Http\Request;

class BraketController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brakets=Braket::all();
        return view('brakets/index',['brakets'=>$brakets]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('brakets/create');
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

        $brakets=new Braket($request->all());
        $brakets->save();

        flash('Tipo de braket creado correctamente');

        return redirect()->route('brakets.index');
    }

}
