<?php

namespace App\Http\Controllers;

use App\AsociacionDiagnosticoExam;
use App\Diagnostico;
use App\Diente;
use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsociacionDiagnosticoExamController extends Controller
{
    /**
     * Display a listing of the resource. Student
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
        $exam_id=Exam::find($exam_id)->id;
        $diagnosticos=Diagnostico::all()->pluck('nombre','id');

        return view('asociacion_ExDiags/create',['exam_id'=>$exam_id,'diagnosticos'=>$diagnosticos]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$exam_id)
    {
        $this->validate($request, [
            'diagnostico_id' => 'required|exists:diagnosticos,id',
        ]);

        $asociacion_exam_diagnostico=new AsociacionDiagnosticoExam();
        $asociacion_exam_diagnostico->diagnostico_id= $request->get('diagnostico_id');
        $asociacion_exam_diagnostico->exam_id=$exam_id;
        $asociacion_exam_diagnostico->save();

        flash('Asociación creada correctamente');

        //return redirect()->route('asociacion_ExTratamientos.create',[$exam_id]);
        switch($request->submitbutton) {
            case 'Guardar':
                return redirect()->route('exams.show',$exam_id);
                break;
            case 'Tratamiento':
                return redirect()->route('tratamientos.createT',$exam_id);
                break;
        }
    }


    /**
     * Edit Student
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asociacion=AsociacionDiagnosticoExam::find($id);
        $diagnosticos = Diagnostico::all()->pluck('nombre','id');
        return view('asociacion_ExDiags.edit',['asociacion'=>$asociacion,'diagnosticos'=> $diagnosticos]);
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
            'diagnostico_id' => 'required|exists:diagnosticos,id',
        ]);

        $asociacion_exam_diagnostico=AsociacionDiagnosticoExam::find($id);
        $asociacion_exam_diagnostico->diagnostico_id= $request->get('diagnostico_id');
        $asociacion_exam_diagnostico->save();

        flash('Diagnóstico creado correctamente');

        return redirect()->route('exams.show',$asociacion_exam_diagnostico->exam_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($diagnostico_id,Request $request)
    {
        $asociacion = AsociacionDiagnosticoExam::where('diagnostico_id','=',$diagnostico_id)
            ->where('exam_id','=',$request->exam_id)->first();
        $exam_id=$asociacion->exam_id;
        $asociacion->delete();
        flash('Diagnostico borrado correctamente');

        return redirect()->route('exams.show',$exam_id);
    }

}
