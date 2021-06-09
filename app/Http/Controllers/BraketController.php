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
        $braket = Braket::find($id);
        return view('brakets/edit',['braket'=> $braket]);
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

        $braket = Braket::find($id);
        $braket->fill($request->all());
        $braket->save();

        flash('Tipo creado correctamente');

        return redirect()->route('brakets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $braket = Braket::find($id);
        $braket->delete();
        flash('Tipo borrado correctamente');

        return redirect()->route('brakets.index');
    }
}
