<?php

namespace App\Http\Controllers;

use App\AsociacionDiagnosticoExam;
use App\AsociacionExamDiente;
use App\Diagnostico;
use App\Exam;
use App\Mail\CorreoPago;
use App\Patient;
use App\PruebaComplementaria;
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
    public function index($id, Request $request)
    {
        $exams=Exam::where('exams.patient_id','=',$id)
            ->where('exams.tipoExam','LIKE','%'.$request->get("query")."%")
            ->where('exams.date','LIKE','%'.$request->get("query2")."%")
            ->get();
        $patient=Patient::find($id);

        return view('exams/index',['exams'=>$exams,'patient'=>$patient,'id'=>$id]);
    }
    public function indexExamsAdmin(Request $request)
    {
        $exams=Exam::where('exams.tipoExam','LIKE','%'.$request->get("query")."%")
            ->where('exams.date','LIKE','%'.$request->get("query2")."%")
            ->get();

        return view('exams/indexExamAdmin',['exams'=>$exams]);
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

        return view('exams/evaluaciones',['evaluaciones'=>$evaluaciones]);
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
            'date'=>['required','date'],
            'tipoExam'=>['required','string','in:inicial,infantil,periodoncial,ortodoncial,evOrto,otro'],
            'pin'=>['required','string'],
            'patient_id' => ['required', 'exists:patients,id'],
        ]);

        $profesores=User::find(Auth::user()->id)->teachers()
            ->where('pin','=',MD5($request->pin))->get();

        if(count($profesores)==0) {
            flash('Pin incorrecto');
            return redirect()->route('exams.create');
        }

        $user=User::where('pin','=',MD5($request->pin))->first();
        $exam = new Exam($request->all());
        $exam->teacher_id=$user->id;
        $exam->iva=0;
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
            'date' => ['required', 'date'],
            'tipoExam' => ['required', 'string', 'in:inicial,infantil,periodoncial,ortodoncial,evOrto,otro'],
            'patient_id' => ['required', 'exists:patients,id']
        ]);

        $exam = new Exam($request->all());
        $exam->iva=0;
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
        $diagnosticos=$exam->diagnosticos()->get();
        $tratamientos=$exam->tratamientos()->get();
        $prueba_complementarias=$exam->PruebaComplementarias()->get();
        $coste_total=0;
        foreach ($tratamientos as $tratamiento) {
            $coste_total = $tratamiento->coste + $coste_total;
        }
        return view('exams/show',['exam'=> $exam,'diagnosticos'=>$diagnosticos,'tratamientos'=>$tratamientos,'prueba_complementarias'=>$prueba_complementarias,'coste_total'=>$coste_total]);
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
        $exam = Exam::find($id);
        $this->validate($request,[
            'otros' => ['nullable', 'string', 'max:1000'],
            'pin' => ['required', 'string']
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
                'indicePlaca'=>['nullable','string', 'max:255'],
                'color'=>['required','string', 'in:rosa,rojo'],
                'borde'=>['required','string', 'in:afilado,engrosado'],
                'aspecto'=>['required','string', 'in:puntillado,liso'],
                'consistencia'=>['required','string', 'in:firme,depresible'],
                'biotipo'=>['required','integer'],
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


        $profesores=User::find(Auth::user()->id)->teachers()
            ->where('pin','=',MD5($request->pin))->get();

        if(count($profesores)==0){
        flash('Pin incorrecto');
        return redirect()->route('exams.edit',$id);
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
                'date' => ['required', 'date'],
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
                'indicePlaca'=>['nullable','string', 'max:255'],
                'color'=>['required','string', 'in:rosa,rojo'],
                'borde'=>['required','string', 'in:afilado,engrosado'],
                'aspecto'=>['required','string', 'in:puntillado,liso'],
                'consistencia'=>['required','string', 'in:firme,depresible'],
                'biotipo'=>['required','integer'],
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

        switch($request->submitbutton) {
            case 'Continuar examen dental':
                return redirect()->route('create_asociacionED',[$exam->id]);
                break;
            case 'Guardar':
                return redirect()->route('exams.show',[$exam->id]);
                break;
        }
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
            'talla'=>['required','string', 'max:255'],
            'peso'=>['required','string', 'max:255'],
            'piel'=>['required','string', 'max:255'],
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
            'indicePlaca'=>['nullable','string', 'max:255'],
            'color'=>['required','string', 'in:rosa,rojo'],
            'borde'=>['required','string', 'in:afilado,engrosado'],
            'aspecto'=>['required','string', 'in:puntillado,liso'],
            'consistencia'=>['required','string', 'in:firme,depresible'],
            'biotipo'=>['required','integer'],
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen creado correctamente');

        switch($request->submitbutton) {
            case 'Continuar examen dental':
                return redirect()->route('create_asociacionEDPeriodoncia',[$exam->id]);
                break;
            case 'Guardar':
                return redirect()->route('exams.show',[$exam->id]);
                break;
        }
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
            'pin'=>['required','integer']
        ]);

        $profesores=User::find(Auth::user()->id)->teachers()
            ->where('pin','=',MD5($request->pin))->get();

        if(count($profesores)==0){
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
        $patient_id=$exam->patient_id;
        $exam->delete();
        flash('Examen borrado correctamente');

        return redirect()->route('exams.index',$patient_id);
    }

    public function destroy()
    {

    }
    public function imprimir($id){
        $exam=Exam::find($id);
        $exam = Exam::find($id);
        $diagnosticos=$exam->diagnosticos()->get();
        $tratamientos=$exam->tratamientos()->get();
        $prueba_complementarias=$exam->PruebaComplementarias()->get();
        $coste_total=0;
        foreach ($tratamientos as $tratamiento) {
            $coste_total = $tratamiento->coste + $coste_total;
        }
        $pdf = \PDF::loadView('exams/pdf',['exam'=>$exam,'diagnosticos'=>$diagnosticos,
            'tratamientos'=>$tratamientos,'prueba_complementarias'=>$prueba_complementarias,
            'coste_total'=>$coste_total]);

        return $pdf->download('pdf.pdf');
    }
    public function edit_iva($exam_id){
        $exam=Exam::find($exam_id);
        return view('exams/edit_iva',['exam'=>$exam]);

    }
    public function update_iva($exam_id,Request $request){
        $this->validate($request, [
            'iva'=>['nullable','integer','max:100'],
        ]);

        $exam = Exam::find($exam_id);
        $exam->fill($request->all());
        $exam->save();

        flash('Examen creado correctamente');
        return redirect()->route('exams.show',[$exam_id]);
    }

    public function correo_pago($exam_id){
        $exam=Exam::find($exam_id);
        $correo=Patient::find($exam->patient_id)->pluck('email');
        Mail::to($correo)->send(new CorreoPago($exam));
    }
    public function pagado($exam_id){
        $exam=Exam::find($exam_id);
        $exam->cobrado=true;
        $exam->save();
        return redirect()->route('exams.show',[$exam_id]);

    }
}
