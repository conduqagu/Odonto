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

        return redirect()->route('tratamientos.create',[$exam_id]);
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
        $asociacion_exam_diente = AsociacionExamDiente::find($id);

        $diente = DB::table('asociacion_exam_dientes')
            //  ->where('exam_id','=',$exam_id)
            ->join('dientes','dientes.id','!=','asociacion_exam_dientes.diente_id')
            ->select('dientes.*')
            ->get();
        $dientes=$diente->pluck('number', 'id');

        return view('exams/student/edit_asociacion_exam_diente',['asociacion_exam_diente'=> $asociacion_exam_diente,'dientes'=>$dientes ]);
    }
    public function editasociacionEDTeacher($id)
    {
        $asociacion_exam_diente = AsociacionExamDiente::find($id);

        $diente = DB::table('asociacion_exam_dientes')
            ->join('dientes','dientes.id','!=','asociacion_exam_dientes.diente_id')
            ->select('dientes.*')
            ->get();
        $dientes=$diente->pluck('number', 'id');

        return view('exams/edit_asociacion_exam_dienteTeacher',['asociacion_exam_diente'=> $asociacion_exam_diente,'dientes'=>$dientes ]);
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
            'denticionRaiz' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'denticionCorona' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'tratamiento' => 'required|String|in:Ninguno,Preventivo,Obturación de fisuras,Obt. 1 o mas superficies,Obt 2 o mas superficies,
                Corona,Carilla estética,Tratamiento pulgar,Exodoncia,No registrado',
            'opacidad' => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
            'diente_id' => 'required|exists:dientes,id',
            'pin'=>['required','string','max:255']
        ]);

        $profesor=DB::select(DB::raw('SELECT * FROM laravel.users
        LEFT JOIN laravel.asociacion_teacher_students ON (laravel.asociacion_teacher_students.student_id = users.id)
        LEFT JOIN laravel.users as teachers ON (teachers.id = laravel.asociacion_teacher_students.teacher_id)
        WHERE laravel.users.id ='.Auth::user()->id.' AND teachers.pin='.$request->get('pin').';'));

        if(count($profesor)==0){
            flash('Pin incorrecto');
            return redirect()->route('edit_asociacionED',$id);
        }

        $asociacion_exam_diente = AsociacionExamDiente::find($id);
        $asociacion_exam_diente->fill($request->all());
        $asociacion_exam_diente->save();

        flash('Asociación editada correctamente');

        return redirect()->route('index_asociacionED',[$asociacion_exam_diente->exam_id]);

    }
    /**
     * Update Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateasociacionEDTeacher(Request $request, $id)
    {
        $this->validate($request, [
            'denticionRaiz' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'denticionCorona' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'tratamiento' => 'required|String|in:Ninguno,Preventivo,Obturación de fisuras,Obt. 1 o mas superficies,Obt 2 o mas superficies,
                Corona,Carilla estética,Tratamiento pulgar,Exodoncia,No registrado',
            'opacidad' => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
            'diente_id' => 'required|exists:dientes,id',
        ]);

        $asociacion_exam_diente = AsociacionExamDiente::find($id);
        $asociacion_exam_diente->fill($request->all());
        $asociacion_exam_diente->save();

        flash('Asociación editada correctamente');

        return redirect()->route('indexasociacionEDTeacher',[$asociacion_exam_diente->exam_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asociacion_exam_diente = Diente::find($id);
        $asociacion_exam_diente->delete();

        flash('Asociación eliminada correctamente');

        return redirect()->route('asociacion_exam_dientes/student/index');

    }
}
