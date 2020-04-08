<?php

namespace App\Http\Controllers;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data-> all(), [
            'date'=>['required','date'],
            'aspectoExtraoralNormal' => ['required', 'boolean'],
            'cancerOral' => ['required', 'boolean'],
            'anomaliasLabios' => ['required', 'boolean' ],
            'otros' => ['required', 'string', 'max:1000'],
            'patologiaMucosa'=> ['required', 'string','in: Tumor maligno,leucoplasia,Liquen plano'],
            'fluorosis'=> ['required', 'string','in: Normal, Discutible, Muy ligera, Ligera,
                 Moderada, Intensa , Excluida, No registrada'],
            'estadoS1'=> ['required', 'string','in: sano,hemorragia,tártaro,bolsa 4-5 mm, Bolsa de 6 mm o más, excluido'],
            'estadoS2'=> ['required', 'string','in: sano,hemorragia,tártaro,bolsa 4-5 mm, Bolsa de 6 mm o más, excluido'],
            'estadoS3'=> ['required', 'string','in: sano,hemorragia,tártaro,bolsa 4-5 mm, Bolsa de 6 mm o más, excluido'],
            'estadoS4'=> ['required', 'string','in: sano,hemorragia,tártaro,bolsa 4-5 mm, Bolsa de 6 mm o más, excluido'],
            'estadoS5'=> ['required', 'string','in: sano,hemorragia,tártaro,bolsa 4-5 mm, Bolsa de 6 mm o más, excluido'],
            'estadoS6'=> ['required', 'string','in: sano,hemorragia,tártaro,bolsa 4-5 mm, Bolsa de 6 mm o más, excluido'],
            'claseAngle'=> ['required', 'string','in: calse I, calse II, calse III'],
            'lateralAngle'=> ['required', 'string','in: Unilateral, Bilateral'],
            'tipoDentición'=> ['required', 'string','in: Temporal, Mixta'],
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {
        return Exam::create([
            'date' => $data['date'],
            'aspectoExtraoralNormal' => $data['aspectoExtraoralNormal'],
            'cancerOral' => $data['cancerOral'],
            'anomaliasLabios'=>$data['anomaliasLabios'],
            'otros' => $data['otros'],
            'patologiaMucosa' => $data['patologiaMucosa'],
            'fluorosis' => $data['fluorosis'],
            'estadoS1' => $data['estadoS1'],
            'estadoS2' => $data['estadoS2'],
            'estadoS3' => $data['estadoS3'],
            'estadoS4' => $data['estadoS4'],
            'estadoS5' => $data['estadoS5'],
            'estadoS6' => $data['estadoS6'],
            'claseAngle' => $data['claseAngle'],
            'lateralAngle' => $data['lateralAngle'],
            'tipoDentición' => $data['tipoDentición'],
            'apiñamientoIncisivoInferior' => $data['apiñamientoIncisivoInferior'],
            'apiñamientoIncisivoSuperior' => $data['apiñamientoIncisivoSuperior'],
            'perdidaEspacioAnterior' => $data['perdidaEspacioAnterior'],
            'perdidaEspacioPosterior' => $data['perdidaEspacioPosterior'],
            'mordidaCruzadaAnterior' => $data['mordidaCruzadaAnterior'],
            'mordidaCruzadaPosterior' => $data['mordidaCruzadaPosterior'],
            'desviacionLineaMedia' => $data['desviacionLineaMedia'],
            'mordidaAbierta' => $data['mordidaAbierta'],
            'habitos' => $data['habitos'],

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
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
        //
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
        $this->validator($request);

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
