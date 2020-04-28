<?php

namespace App\Http\Controllers;

use App\AsociacionExamDiente;
use App\Exam;
use App\Patient;
use Illuminate\Http\Request;

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
    public function index()
    {
        $exams=Exam::all();
        return view('exams.index',['exams'=>$exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all()->pluck('name','id');
        return view('exams.create',['patients'=>$patients]);
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
            'patient_id' => ['required', 'exists:patients,id']
        ]);


        $exam = new Exam($request->all());
        $exam->save();

        flash('Exam creado correctamente');

        return redirect()->route('exams.index');
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

        return view('exams/edit',['exam'=> $exam, 'patients'=>$patients ]);
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
            'patient_id' => ['required', 'exists:patients,id']
        ]);

        $exam = Exam::find($id);
        $exam->fill($request->all());

        $exam->save();

        flash('Examen modificado correctamente');

        return redirect()->route('exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $exam = Exam::find($id);
            $exam->delete();
            flash('Examen borrado correctamente');

            return redirect()->route('exams.index');
    }
}
