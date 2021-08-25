<?php

namespace App\Http\Controllers;

use App\AsociacionDiagnosticoExam;
use App\AsociacionExamDiente;
use App\Braket;
use App\Diagnostico;
use App\Exam;
use App\Mail\CorreoPago;
use App\Patient;
use App\PruebaComplementaria;
use App\Rules\PinProfesor;
use App\Tratamiento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
    /**public function index($id, Request $request)
    {
        $patient=Patient::find($id);
        if($request->semibutton=='Borrar filtro') {
            $request->replace(['query'=>null]);
            $request->replace(['query2'=>null]);
        }
        $exams=Exam::where('exams.patient_id','=',$id)
            ->where('exams.tipoExam','LIKE','%'.$request->get("query")."%")
            ->where('exams.date','LIKE','%'.$request->get("query2")."%")
            ->get();


        return view('exams/index',['exams'=>$exams,'patient'=>$patient,'id'=>$id]);
    }*/
    public function indexExamsAdmin(Request $request)
    {
        if($request->semibutton=='Borrar filtro') {
            \Cookie::queue('query_exam_admin', null, 60);
            \Cookie::queue('query_exam_admin2', null, 60);
            $query_exam_admin=null;
            $query_exam_admin2=null;
        }else {
            if ($request->get("query_exam_admin") != null) {
                $this->validate($request, [
                    'query_exam_admin' => ['string', 'in:inicial,infantil,periodoncial,ortodoncial,evOrto,otro'],
                ]);
                \Cookie::queue('query_exam_admin', $request->get("query_exam_admin"), 60);
                $query_exam_admin = $request->get("query_exam_admin");
            } else {
                $query_exam_admin = \Request::cookie('query_exam_admin');
            }
            if ($request->get("query_exam_admin2") != null) {
                $this->validate($request, [
                    'query_exam_admin2' => ['date','date_format:Y-m-d'],
                ]);
                \Cookie::queue('query_exam_admin2', $request->get("query_exam_admin2"), 60);
                $query_exam_admin2 = $request->get("query_exam_admin2");
            } else {
                $query_exam_admin2 = \Request::cookie('query_exam_admin2');
            }
        }
        $exams=Exam::where('exams.tipoExam','LIKE','%'.$query_exam_admin."%")
            ->where('exams.date','LIKE','%'.$query_exam_admin2."%")
            ->paginate(20);

        return view('exams/indexExamAdmin',['exams'=>$exams, 'query_exam_admin'=>$query_exam_admin, 'query_exam_admin2'=>$query_exam_admin2]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $patient = Patient::find($id);
        return view('exams/student/create',['patient'=>$patient]);
    }

    public function examsCreateTeacher($id)
    {
        $patient = Patient::find($id);
        return view('exams/examsCreateTeacher',['patient'=>$patient]);
    }
    public function examsCreateTeacherInicial($id)
    {
        $exam=Exam::find($id);
        return view('exams/create_exam_inicial_teacher',['exam'=>$exam,'id'=>$id]);
    }
    public function examsCreateTeacherInfantil($id)
    {
        $exam=Exam::find($id);
        return view('exams/create_exam_infantil_teacher',['exam'=>$exam,'id'=>$id]);
    }
    public function examsCreateTeacherPeriodontal($id)
    {
        $exam=Exam::find($id);
        return view('exams/create_exam_periodontal_teacher',['exam'=>$exam,'id'=>$id]);
    }
    public function examsCreateTeacherOrtodoncia($id)
    {
        $exam=Exam::find($id);
        return view('exams/create_exam_ortodoncia_teacher',['exam'=>$exam,'id'=>$id]);
    }
    public function examsCreateTeacherevOrto($id)
    {
        $exam=Exam::find($id);
        $ortodoncias=Exam::all()->where('patient_id','=',$exam->patient_id)
            ->where('tipoExam','=','ortodoncial')->pluck('date','id');
        return view('exams/create_exam_evOrto_teacher',['exam'=>$exam,'id'=>$id,'ortodoncias'=>$ortodoncias]);
    }
    public function evaluaciones($id)
    {
        $evaluaciones=Exam::all()->where('orto_id','=',$id);


        return view('exams/evaluaciones',['evaluaciones'=>$evaluaciones,'exam_id'=>$id]);
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
            'date'=>['required','date','date_format:Y-m-d','before_or_equal:now'],
            'tipoExam'=>['required','string','in:inicial,infantil,periodoncial,ortodoncial,evOrto,otro'],
            'pin'=>['required','string','max:255',new PinProfesor()],
            'patient_id' => ['required', 'exists:patients,id'],
        ]);


        $user=User::where('pin','=',MD5($request->pin))->first();
        $exam = new Exam($request->all());
        $exam->teacher_id=$user->id;
        $exam->cobrado=false;
        $exam->save();

        flash('Examen creado correctamente');
        if ($exam->tipoExam=='inicial'){
            return redirect()->route('examsCreateTeacherInicial',[$exam->id]);
        }else if ($exam->tipoExam=='infantil'){
            return redirect()->route('examsCreateTeacherInfantil',[$exam->id]);
        }else if ($exam->tipoExam=='periodoncial'){
            return redirect()->route('examsCreateTeacherPeriodontal',[$exam->id]);
        }else if ($exam->tipoExam=='ortodoncial'){
            return redirect()->route('examsCreateTeacherOrtodoncia',[$exam->id]);
        }else if ($exam->tipoExam=='evOrto'){
            return redirect()->route('examsCreateTeacherevOrto',[$exam->id]);
        }else if ($exam->tipoExam=='otro'){
            return redirect()->route('exams.show',[$exam->id]);
        }
    }
    /**
     * Store a newly created resource in storage for a Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examsStoreTeacher(Request $request)
    {
        $this->validate($request, [
            'date'=>['required','date','date_format:Y-m-d','before_or_equal:now'],
            'tipoExam' => ['required', 'string', 'in:inicial,infantil,periodoncial,ortodoncial,evOrto,otro'],
            'patient_id' => ['required', 'exists:patients,id']
        ]);

        $exam = new Exam($request->all());
        $exam->cobrado=false;
        $exam->save();

        if ($exam->tipoExam == 'inicial') {
            return redirect()->route('examsCreateTeacherInicial', [$exam->id]);
        } else if ($exam->tipoExam == 'infantil') {
            return redirect()->route('examsCreateTeacherInfantil', [$exam->id]);
        } else if ($exam->tipoExam == 'periodoncial') {
            return redirect()->route('examsCreateTeacherPeriodontal', [$exam->id]);
        } else if ($exam->tipoExam == 'ortodoncial') {
            return redirect()->route('examsCreateTeacherOrtodoncia', [$exam->id]);
        } else if ($exam->tipoExam == 'evOrto') {
            return redirect()->route('examsCreateTeacherevOrto', [$exam->id]);
        }else if ($exam->tipoExam=='otro'){
            return redirect()->route('exams.show',[$exam->id]);
        }

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
        $diagnosticos=$exam->diagnosticos()->paginate(8, ['*'], "page_a");
        $tratamientos1=$exam->tratamientos()->get();
        $prueba_complementarias=$exam->PruebaComplementarias()->paginate(8, ['*'], "page_c");
        $coste_total=0.0;
        foreach ($tratamientos1 as $tratamiento) {
            $coste_total = $tratamiento->tipoTratamiento->coste + $coste_total;
        }
        $tratamientos=$exam->tratamientos()->paginate(8, ['*'], "page_b");

        $asociacion_exam_dientes = AsociacionExamDiente::where('exam_id', '=', $exam->id)->paginate(10, ['*'], "page_d");
        foreach ($asociacion_exam_dientes as $asoc_ed){
            //dd(Tratamiento::where('asociacion_exam_diente_id','=',$asoc_ed->id)->first());
            //dd($asoc_ed->tratamiento);
        }



        return view('exams/show',['exam'=> $exam,'diagnosticos'=>$diagnosticos,'tratamientos'=>$tratamientos,
            'prueba_complementarias'=>$prueba_complementarias,'coste_total'=>$coste_total,
            'asociacion_exam_dientes'=>$asociacion_exam_dientes]);
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
        $ortodoncia=Exam::all()->where('patient_id','=',$exam->patient_id)->where('tipoExam',
            '=','ortodoncial')->pluck('date','id');

        return view('exams/student/edit',['exam'=> $exam, 'ortodoncia'=>$ortodoncia]);
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
        $exam = Exam::find($id);
        $this->validate($request,[
            'otros' => ['nullable', 'string', 'max:1000'],
            'pin'=>['required','string','max:255',new PinProfesor()]
        ]);
        if($exam->tipoExam=='inicial') {
            $this->validate($request, [
                'aspectoExtraoralNormal' => ['required', 'boolean'],
                'aspectoExtraoralNormal' => ['required', 'boolean'],
                'cancerOral' => ['required', 'boolean'],
                'anomaliasLabios' => ['required', 'boolean'],
                'patologiaMucosa' => ['string', 'in:Ninguna,Tumor maligno,leucoplasia,Liquen plano'],
                'fluorosis' => ['required', 'string', 'in:Normal,Discutible,Muy ligera,Ligera,
                Moderada,Intensa,Excluida,No registrada'],
                'estadoS1' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS2' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS3' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS4' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS5' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS6' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'claseAngle' => ['required', 'string', 'in:clase I,clase II,clase III'],
                'lateralAngle' => ['required', 'string', 'in:Unilateral,Bilateral'],
                'tipoDentición' => ['required', 'string', 'in:Temporal,Mixta'],
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
        }elseif ($exam->tipoExam=='infantil'){
            $this->validate($request, [
                'aspectoGeneral'=>['required','string', 'max:255'],
                'talla'=>['nullable','string', 'max:255'],
                'peso'=>['nullable','string', 'max:255'],
                'piel'=>['nullable','string', 'max:255'],
                'anomaliaForma'=>['required','string', 'max:255'],
                'anomaliaTamaño'=>['required','string', 'max:255'],
            ]);
        }elseif($exam->tipoExam=='periodoncial'){

            $this->validate($request, [
                'indicePlaca'=>['nullable','regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],
                'color'=>['required','string', 'in:rosa,rojo'],
                'borde'=>['required','string', 'in:afilado,engrosado'],
                'aspecto'=>['required','string', 'in:puntillado,liso'],
                'consistencia'=>['required','string', 'in:firme,depresible'],
                'biotipo'=>['required','string','in:normal,fino,grueso'],
            ]);
        }elseif($exam->tipoExam=='ortodoncial'){
            $this->validate($request, [
                'patronFacial'=>['required','string','in:dolicofacial,mesofacial,braquifacial'],
                'perfil'=>['required','string','in:armonico,convexo,concavo,plano'],
                'menton'=>['required','string','in:marcado,normal,retruido,plano'],
            ]);
        }elseif($exam->tipoExam=='evOrto'){
            $this->validate($request, [
                'previsto'=>['nullable','string','max:255'],
                'maxilar'=>['nullable','string','max:255'],
                'mandibular'=>['nullable','string','max:255'],
                'logrado'=>['nullable','string','max:255'],
                'orto_id'=>['required','exists:exams,id']
            ]);
        }


        $user=User::where('pin','=',MD5($request->pin))->first();
        $exam->teacher_id=$user->id;
        $exam->fill($request->all());

        $exam->save();

        flash('Examen modificado correctamente');

        return redirect()->route('exams.show',$id);
    }
    public function examsUpdateTeacher(Request $request, $id)
    {
        $exam = Exam::find($id);
        $this->validate($request,[
            'otros' => ['nullable', 'string', 'max:1000'],
        ]);
        if($exam->tipoExam=='inicial') {
            $this->validate($request, [
                'aspectoExtraoralNormal' => ['required', 'boolean'],
                'cancerOral' => ['required', 'boolean'],
                'anomaliasLabios' => ['required', 'boolean'],
                'patologiaMucosa' => ['string', 'in:Ninguna,Tumor maligno,leucoplasia,Liquen plano'],
                'fluorosis' => ['required', 'string', 'in:Normal,Discutible,Muy ligera,Ligera,
                Moderada,Intensa,Excluida,No registrada'],
                'estadoS1' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS2' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS3' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS4' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS5' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'estadoS6' => ['required', 'string', 'in:sano,hemorragia,tártaro,bolsa 4-5 mm,Bolsa de 6 mm o más,excluido'],
                'claseAngle' => ['required', 'string', 'in:clase I,clase II,clase III'],
                'lateralAngle' => ['required', 'string', 'in:Unilateral,Bilateral'],
                'tipoDentición' => ['required', 'string', 'in:Temporal,Mixta'],
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
        }elseif ($exam->tipoExam=='infantil'){
            $this->validate($request, [
                'aspectoGeneral'=>['required','string', 'max:255'],
                'talla'=>['required','string', 'max:255'],
                'peso'=>['required','string', 'max:255'],
                'piel'=>['required','string', 'max:255'],
                'anomaliaForma'=>['required','string', 'max:255'],
                'anomaliaTamaño'=>['required','string', 'max:255'],
            ]);
        }elseif($exam->tipoExam=='periodoncial'){
            $this->validate($request, [
                'indicePlaca'=>['nullable','regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],
                'color'=>['required','string', 'in:rosa,rojo'],
                'borde'=>['required','string', 'in:afilado,engrosado'],
                'aspecto'=>['required','string', 'in:puntillado,liso'],
                'consistencia'=>['required','string', 'in:firme,depresible'],
                'biotipo'=>['required','string','in:normal,fino,grueso'],
            ]);
        }elseif($exam->tipoExam=='ortodoncial'){
            $this->validate($request, [
                'patronFacial'=>['required','string','in:dolicofacial,mesofacial,braquifacial'],
                'perfil'=>['required','string','in:armonico,convexo,concavo,plano'],
                'menton'=>['required','string','in:marcado,normal,retruido,plano'],
            ]);
        }elseif($exam->tipoExam=='evOrto'){
            $this->validate($request, [
                'previsto'=>['nullable','string','max:255'],
                'maxilar'=>['nullable','string','max:255'],
                'mandibular'=>['nullable','string','max:255'],
                'logrado'=>['nullable','string','max:255'],
            ]);
        }
        $exam->fill($request->all());

        $exam->save();

        flash('Examen modificado correctamente');

        return redirect()->route('exams.show',$id);
    }
    /**
     * Update "Examen inicial" for a Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examsUptadeTeacherInicial(Request $request, $id)
    {
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
        return redirect()->route('exams.show',[$exam->id]);

    }
    /**
     * Update "Examen Infantil" for a Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examsUptadeTeacherInfantil(Request $request, $id)
    {
        $this->validate($request, [
            'aspectoGeneral'=>['required','string', 'max:255'],
            'talla'=>['nullable','string', 'max:255'],
            'peso'=>['nullable','string', 'max:255'],
            'piel'=>['nullable','string', 'max:255'],
            'anomaliaForma'=>['required','string', 'max:255'],
            'anomaliaTamaño'=>['required','string', 'max:255'],
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen creado correctamente');
        return redirect()->route('exams.show',[$exam->id]);
    }

    /**
     * Update "Examen Infantil" for a Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examsUptadeTeacherPeriodontal(Request $request, $id)
    {
        $this->validate($request, [
            'indicePlaca'=>['nullable','regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],
            'color'=>['required','string', 'in:rosa,rojo'],
            'borde'=>['required','string', 'in:afilado,engrosado'],
            'aspecto'=>['required','string', 'in:puntillado,liso'],
            'consistencia'=>['required','string', 'in:firme,depresible'],
            'biotipo'=>['required','string','in:normal,fino,grueso'],
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen creado correctamente');
        return redirect()->route('exams.show',[$exam->id]);

    }
    /**
     * Update "Examen Ortodoncial" for a Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examsUptadeTeacherOrtodoncia(Request $request, $id)
    {
        $this->validate($request, [
            'patronFacial'=>['required','string','in:dolicofacial,mesofacial,braquifacial'],
            'perfil'=>['required','string','in:armonico,convexo,concavo,plano'],
            'menton'=>['required','string','in:marcado,normal,retruido,plano'],
            'otros'=>['nullable','string','max:255']
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen creado correctamente');
        return redirect()->route('exams.show',[$exam->id]);
    }
    /**
     * Update "Examen Evaluacion Ortodoncia" for a Teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examsUptadeTeacherevOrto(Request $request, $id)
    {
        $this->validate($request, [
            'previsto'=>['nullable','string','max:255'],
            'maxilar'=>['nullable','string','max:255'],
            'mandibular'=>['nullable','string','max:255'],
            'logrado'=>['nullable','string','max:255'],
            'otros'=>['nullable','string','max:255'],
            'orto_id'=>['required','exists:exams,id']
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());
        $exam->orto_id=$request->orto_id;
        $exam->save();


        flash('Examen creado correctamente');
        return redirect()->route('exams.show',[$exam->id]);

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
            'pin'=>['required','string','max:255',new PinProfesor()]
        ]);

        $exam = Exam::find($id);
        $exam->delete();
        flash('Examen borrado correctamente');

        return redirect()->route('exams/student/index');
    }

    public function examsdeleteTeacher($id)
    {
        $exam = Exam::find($id);
        $patient_id=$exam->patient_id;
        $exam->delete();
        flash('Examen borrado correctamente');

        return redirect()->route('patients.show',$patient_id);
    }

    public function destroy()
    {

    }
    public function imprimir($id){
        $exam = Exam::find($id);
        $diagnosticos=$exam->diagnosticos()->get();
        $tratamientos=$exam->tratamientos()->get();
        $prueba_complementarias=$exam->PruebaComplementarias()->get();
        $coste_total=0.0;
        foreach ($tratamientos as $tratamiento) {
            $coste_total = $tratamiento->tipoTratamiento->coste + $coste_total;
        }
        $pdf = \PDF::loadView('exams/pdf',['exam'=>$exam,'diagnosticos'=>$diagnosticos,
            'tratamientos'=>$tratamientos,'prueba_complementarias'=>$prueba_complementarias,
            'coste_total'=>$coste_total]);

        return $pdf->download('pdf.pdf');
    }


    public function correo_pago($exam_id){
        flash('Correo enviado correctamente');
        $exam=Exam::find($exam_id);
        $patient_email=$exam->patient->email;
        //$correo=Patient::find($patient->patient_id)->pluck('email');
        Mail::to($patient_email)->send(new CorreoPago($exam));
        return redirect()->route('exams.show',$exam_id);
    }
    public function pagado($exam_id){
        $exam=Exam::find($exam_id);
        $exam->cobrado=true;
        $exam->save();
        return redirect()->route('exams.show',[$exam_id]);

    }
    public function no_pagado($exam_id){
        $exam=Exam::find($exam_id);
        $exam->cobrado=false;
        $exam->save();
        return redirect()->route('exams.show',[$exam_id]);

    }
}
