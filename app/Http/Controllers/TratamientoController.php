<?php

namespace App\Http\Controllers;

use App\Braket;
use App\Diagnostico;
use App\TipoTratamiento;
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
    public function createT($exam_id)
    {
        $tipo_tratamientos=TipoTratamiento::all()->pluck('name','id');
        $brakets=Braket::all()->pluck('name','id');
        return view('tratamientos/create',['brakets'=>$brakets,'tipo_tratamientos'=>$tipo_tratamientos,'exam_id'=>$exam_id]);
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
            'realizado' => ['required', 'boolean'],
            'coste' => ['required', 'integer', 'max:255'],
            'iva' => ['required', 'integer', 'max:255'],
            'terapia' => ['required', 'string', 'in:sin definir,convencional,fases'],
            'duracionEstimada' => ['nullable', 'string', 'max:255'],
            'braket_id' => ['nullable', 'exists:brakets,id'],
            'tipo_tratamiento_id' => ['required', 'exists:tipo_tratamientos,id'],
            'exam_id' =>['required','exists:exams,id']
        ]);
        $tratamientos=new Tratamiento($request->all());
        $tratamientos->save();
        flash('Tratamiento creado correctamente');

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
