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

}
