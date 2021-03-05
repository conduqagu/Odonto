<?php

namespace App\Http\Controllers;

use App\AsociacionExamDiente;
use App\Exam;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $exams=Exam::where('exams.patient_id','=',$id)->get();
        return view('exams/student/index',['exams'=>$exams,'id'=>$id]);
    }
    public function examsIndexTeacher($id)
    {
        $exams=Exam::where('exams.patient_id','=',$id)->get();
        return view('exams/examsIndexTeacher',['exams'=>$exams,'id'=>$id]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all()->pluck('name','id');
        return view('exams/student/create',['patients'=>$patients]);
    }

    public function examsCreateTeacher($id)
    {
        $patients = Patient::all()->pluck('name','id');
        return view('exams/examsCreateTeacher',['patients'=>$patients,'id'=>$id]);
    }
    public function examsCreateTeacherInicial($id)
    {
        $exam=Exam::find($id);
        return view('exams/create_exam_inicial_teacher',['exam'=>$exam,'id'=>$id]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'date'=>['required','date'],
            'aspectoExtraoralNormal' => ['required', 'boolean'],
            'cancerOral' => ['required', 'boolean'],
            'anomaliasLabios' => ['required', 'boolean'],
            'otros' => ['nullable','string', 'max:255'],
            'patologiaMucosa'=> ['string','in:Ninguna,Tumor maligno,leucoplasia,Liquen plano'],
            'fluorosis'=> ['required', 'string','in:Normal,Discutible,Muy ligera,Ligera,Moderada,Intensa,Excluida,No registrada'],
            'estadoS1'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS2'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS3'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS4'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS5'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS6'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'claseAngle'=> ['required', 'string','in:clase I,clase II,clase III'],
            'lateralAngle'=> ['required', 'string','in:Unilateral,Bilateral'],
            'tipoDentición'=> ['required', 'string','in:Temporal,Mixta'],
            'apiñamientoIncisivoInferior' => ['required', 'boolean'],
            'apiñamientoIncisivoSuperior' => ['required', 'boolean'],
            'perdidaEspacioAnterior' => ['required', 'boolean'],
            'perdidaEspacioPosterior' => ['required', 'boolean'],
            'mordidaCruzadaAnterior' => ['required', 'boolean'],
            'mordidaCruzadaPosterior' => ['required', 'boolean'],
            'desviacionLineaMedia' => ['required', 'boolean'],
            'mordidaAbierta' => ['required', 'boolean'],
            'habitos' => ['required', 'boolean'],
            'patient_id' => ['required', 'exists:patients,id'],
            'pin'=>['required','integer']
        ]);

        $profesor=DB::select(DB::raw('SELECT * FROM laravel.users
        LEFT JOIN laravel.asociacion_teacher_students ON (laravel.asociacion_teacher_students.student_id = users.id)
        LEFT JOIN laravel.users as teachers ON (teachers.id = laravel.asociacion_teacher_students.teacher_id)
        WHERE laravel.users.id ='.Auth::user()->id.' AND teachers.pin='.$request->get('pin').';'));

        if(count($profesor)==0) {
            flash('Pin incorrecto');
            return redirect()->route('exams.create');
        }

        $exam = new Exam($request->all());
        $exam->save();

        flash('Examen creado correctamente');

        return redirect()->route('create_asociacionED',['exam_id'=>$exam->id]);
    }
    public function examsStoreTeacher(Request $request)
    {
        $this->validate($request, [
            'date'=>['required','date'],
            'tipoExam'=>['required','string','in:inicial,infantil,evaluacion,periodoncial,ortodoncial,evOrto'],
            'patient_id' => ['required', 'exists:patients,id']
        ]);

        $exam = new Exam($request->all());
        $exam->save();

        flash('Examen creado correctamente');

        if ($request->tipoExam=='inicial'){
            return redirect()->route('examsCreateTeacherInicial',[$exam->id]);
        }
    }

    public function examsUptadeTeacherInicial(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'aspectoExtraoralNormal' => ['required', 'boolean'],
            'cancerOral' => ['required', 'boolean'],
            'anomaliasLabios' => ['required', 'boolean'],
            'otros' => ['nullable','string', 'max:255'],
            'patologiaMucosa'=> ['string','in:Ninguna,Tumor maligno,leucoplasia,Liquen plano'],
            'fluorosis'=> ['required', 'string','in:Normal,Discutible,Muy ligera,Ligera,Moderada,Intensa,Excluida,No registrada'],
            'estadoS1'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS2'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS3'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS4'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS5'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS6'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'claseAngle'=> ['required', 'string','in:clase I,clase II,clase III'],
            'lateralAngle'=> ['required', 'string','in:Unilateral,Bilateral'],
            'tipoDentición'=> ['required', 'string','in:Temporal,Mixta'],
            'apiñamientoIncisivoInferior' => ['required', 'boolean'],
            'apiñamientoIncisivoSuperior' => ['required', 'boolean'],
            'perdidaEspacioAnterior' => ['required', 'boolean'],
            'perdidaEspacioPosterior' => ['required', 'boolean'],
            'mordidaCruzadaAnterior' => ['required', 'boolean'],
            'mordidaCruzadaPosterior' => ['required', 'boolean'],
            'desviacionLineaMedia' => ['required', 'boolean'],
            'mordidaAbierta' => ['required', 'boolean'],
            'habitos' => ['required', 'boolean'],
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen creado correctamente');

        return redirect()->route('create_asociacionED',[$exam->id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);

        return view('exams/show',['exam'=> $exam]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);
        $patients = Patient::all()->pluck('name','id');

        return view('exams/student/edit',['exam'=> $exam, 'patients'=>$patients ]);
    }
    public function examsEditTeacher($id)
    {
        $exam = Exam::find($id);
        $patients = Patient::all()->pluck('name','id');

        return view('exams/examsEditTeacher',['exam'=> $exam, 'patients'=>$patients ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'date'=>['required','date'],
            'aspectoExtraoralNormal' => ['required', 'boolean'],
            'cancerOral' => ['required', 'boolean'],
            'anomaliasLabios' => ['required', 'boolean' ],
            'otros' => ['nullable','string', 'max:1000'],
            'patologiaMucosa'=> ['string','in:Ninguna,Tumor maligno,leucoplasia,Liquen plano'],
            'fluorosis'=> ['required', 'string','in:Normal,Discutible,Muy ligera,Ligera,
                Moderada,Intensa,Excluida,No registrada'],
            'estadoS1'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS2'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS3'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS4'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS5'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS6'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'claseAngle'=> ['required', 'string','in:clase I,clase II,clase III'],
            'lateralAngle'=> ['required', 'string','in:Unilateral,Bilateral'],
            'tipoDentición'=> ['required', 'string','in:Temporal,Mixta'],
            'apiñamientoIncisivoInferior' => ['required', 'boolean'],
            'apiñamientoIncisivoInferior' => ['required', 'boolean'],
            'apiñamientoIncisivoSuperior' => ['required', 'boolean'],
            'perdidaEspacioAnterior' => ['required', 'boolean'],
            'perdidaEspacioPosterior' => ['required', 'boolean'],
            'mordidaCruzadaAnterior' => ['required', 'boolean'],
            'mordidaCruzadaPosterior' => ['required', 'boolean'],
            'desviacionLineaMedia' => ['required', 'boolean'],
            'mordidaAbierta' => ['required', 'boolean'],
            'habitos' => ['required', 'boolean'],
            'patient_id' => ['required', 'exists:patients,id'],
            'pin'=>['required','integer']
        ]);

        $profesor=DB::select(DB::raw('SELECT * FROM laravel.users
        LEFT JOIN laravel.asociacion_teacher_students ON (laravel.asociacion_teacher_students.student_id = users.id)
        LEFT JOIN laravel.users as teachers ON (teachers.id = laravel.asociacion_teacher_students.teacher_id)
        WHERE laravel.users.id ='.Auth::user()->id.' AND teachers.pin='.$request->get('pin').';'));

    if(count($profesor)==0){
        flash('Pin incorrecto');
        return redirect()->route('exams/student/edit',$id);
    }
        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen modificado correctamente');

        return redirect()->route('exams/student/index');
    }
    public function examsUpdateTeacher(Request $request, $id)
    {

        $this->validate($request, [
            'date'=>['required','date'],
            'aspectoExtraoralNormal' => ['required', 'boolean'],
            'cancerOral' => ['required', 'boolean'],
            'anomaliasLabios' => ['required', 'boolean' ],
            'otros' => ['nullable','string', 'max:1000'],
            'patologiaMucosa'=> ['string','in:Ninguna,Tumor maligno,leucoplasia,Liquen plano'],
            'fluorosis'=> ['required', 'string','in:Normal,Discutible,Muy ligera,Ligera,
                Moderada,Intensa,Excluida,No registrada'],
            'estadoS1'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS2'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS3'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS4'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS5'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'estadoS6'=> ['required', 'string','in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
            'claseAngle'=> ['required', 'string','in:clase I,clase II,clase III'],
            'lateralAngle'=> ['required', 'string','in:Unilateral,Bilateral'],
            'tipoDentición'=> ['required', 'string','in:Temporal,Mixta'],
            'apiñamientoIncisivoInferior' => ['required', 'boolean'],
            'apiñamientoIncisivoInferior' => ['required', 'boolean'],
            'apiñamientoIncisivoSuperior' => ['required', 'boolean'],
            'perdidaEspacioAnterior' => ['required', 'boolean'],
            'perdidaEspacioPosterior' => ['required', 'boolean'],
            'mordidaCruzadaAnterior' => ['required', 'boolean'],
            'mordidaCruzadaPosterior' => ['required', 'boolean'],
            'desviacionLineaMedia' => ['required', 'boolean'],
            'mordidaAbierta' => ['required', 'boolean'],
            'habitos' => ['required', 'boolean'],
            'patient_id' => ['required', 'exists:patients,id'],
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen modificado correctamente');

        return redirect()->route('examsIndexTeacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */


    public function examsdestroyStudent($id){
        return view('exams/student/destroyStudent',['id'=>$id]);
    }
    public function examsdeleteStudent(Request $request,$id){

        $this->validate($request, [
            'pin'=>['required','integer']
        ]);

        $profesor=DB::select(DB::raw('SELECT * FROM laravel.users
        LEFT JOIN laravel.asociacion_teacher_students ON (laravel.asociacion_teacher_students.student_id = users.id)
        LEFT JOIN laravel.users as teachers ON (teachers.id = laravel.asociacion_teacher_students.teacher_id)
        WHERE laravel.users.id ='.Auth::user()->id.' AND teachers.pin='.$request->get('pin').';'));

        if(count($profesor)==0){
            flash('Pin incorrecto');
            return redirect()->route('examsdestroyStudent',['id'=>$id]);
        }

        $exam = Exam::find($id);
        $exam->delete();
        flash('Examen borrado correctamente');

        return redirect()->route('exams/student/index');
    }

    public function examsdeleteTeacher($id)
    {
        $exam = Exam::find($id);
        $exam->delete();
        flash('Examen borrado correctamente');

        return redirect()->route('examsIndexTeacher');
    }

    public function destroy()
    {

    }
}
