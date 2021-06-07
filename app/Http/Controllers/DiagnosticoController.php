<?php

namespace App\Http\Controllers;

use App\Diagnostico;
use App\Diente;
use App\Exam;
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

        return view('diagnosticos.create');
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
        $exam_id=$diagnostico->exam_id;
        $diagnostico->delete();
        flash('Diagnostico borrado correctamente');

        return redirect()->route('exams.show',$exam_id);
    }

    public function create_asociacion_diagnostico_exam($exam_id)
    {
        $diagnosticos=Diagnostico::all()->pluck('nombre','id');
        return view('asociacion_ExDiags/create',['exam_id'=>$exam_id,'diagnosticos'=>$diagnosticos]);
    }
    public function store_asociacion_diagnostico_exam(Request $request,$exam_id)
    {
        $this->validate($request, [
            'diagnostico_id' => 'required|exists:diagnosticos,id',
            'comentario'=>['nullable', 'string', 'max:255'],
        ]);

        $exam=Exam::find($exam_id);
        $exam->diagnosticos()->attach($request->diagnostico_id, array('comentario'=>$request->comentario));


        flash('Asociación creada correctamente');

        return redirect()->route('exams.show',$exam_id);

    }
    public function destroy_asociacion_diagnostico_exam($diagnostico_id,Request $request)
    {
        $exam=Exam::find($diagnostico_id);
        $exam->diagnosticos()->detach($request->exam_id);

        flash('Diagnostico borrado correctamente');

        return redirect()->route('exams.show',$request->exam_id);
    }

}
