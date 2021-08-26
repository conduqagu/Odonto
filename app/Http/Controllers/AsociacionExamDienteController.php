<?php

namespace App\Http\Controllers;

use App\AsociacionExamDiente;
use App\Diente;
use App\Exam;
use App\Patient;
use App\Rules\PinProfesor;
use App\TipoTratamiento;
use App\Tratamiento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Void_;
use function foo\func;

class AsociacionExamDienteController extends Controller
{
    /**
     * Display a listing of the resource. Student
     *
     * @return \Illuminate\Http\Response
     */
    public function index($exam_id)
    {
        $asociacion_exam_dientes = AsociacionExamDiente::all()->where('exam_id', '=', $exam_id);

        return view('exams/student/asociacion_exam_diente', ['asociacion_exam_dientes' => $asociacion_exam_dientes, 'exam_id' => $exam_id]);
    }

    /**
     * Display a listing of the resource. Teacher
     *
     * @return \Illuminate\Http\Response
     */
    public function indexasociacionEDTeacher($exam_id)
    {
        $asociacion_exam_dientes = AsociacionExamDiente::all()->where('exam_id', '=', $exam_id);

        return view('asociacion_ExDiente.asociacion_exam_dienteTeacher', ['asociacion_exam_dientes' => $asociacion_exam_dientes, 'exam_id' => $exam_id]);
    }

    /**
     * Display a listing of the resource. Teacher
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPeriodoncia($exam_id)
    {
        $asociacion_exam_dientes = AsociacionExamDiente::all()->where('exam_id', '=', $exam_id);

        return view('asociacion_ExDiente_Periodoncia.index', ['asociacion_exam_dientes' => $asociacion_exam_dientes, 'exam_id' => $exam_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_asociacionED($exam_id)
    {
        $exam = Exam::find($exam_id);
        $patient_id = $exam->patient_id;
        $patient = Patient::find($patient_id);
        $child = $patient->child;
        $tipo_tratamientos=TipoTratamiento::all()->pluck('name','id');


        if ($child == 1) {
            $dientes = Diente::where('dientes.patient_id', '=', $patient_id)
                ->where('number', '>', '50')
                ->whereNotIn('dientes.id', Diente::where('asociacion_exam_dientes.exam_id', '=', $exam_id)
                    ->where('dientes.patient_id', '=', $patient_id)
                    ->join('asociacion_exam_dientes', function ($join) {
                        $join->on('asociacion_exam_dientes.diente_id', '=', 'dientes.id');
                    })->pluck('dientes.id')->values())->get();

        } elseif ($child == 0) {
            $dientes = Diente::where('dientes.patient_id', '=', $patient_id)
                ->where('number', '<', '50')
                ->whereNotIn('dientes.id', Diente::where('asociacion_exam_dientes.exam_id', '=', $exam_id)
                    ->where('dientes.patient_id', '=', $patient_id)
                    ->join('asociacion_exam_dientes', function ($join) {
                        $join->on('asociacion_exam_dientes.diente_id', '=', 'dientes.id');
                    })->pluck('dientes.id')->values())->get();
        }

        return view('asociacion_ExDiente.create_asociacion_exam_diente', ['exam_id' => $exam_id, 'dientes' => $dientes,
            'tipo_tratamientos'=>$tipo_tratamientos]);
    }

    public function create_asociacionEDPeriodoncia($exam_id)
    {
        $exam = Exam::find($exam_id);
        $patient_id = $exam->patient_id;
        $patient = Patient::find($patient_id);
        $child = $patient->child;

        if ($child == 1) {
            $dientes = Diente::where('dientes.patient_id', '=', $patient_id)
                ->where('number', '>', '50')
                ->whereNotIn('dientes.id', Diente::where('asociacion_exam_dientes.exam_id', '=', $exam_id)
                    ->where('dientes.patient_id', '=', $patient_id)
                    ->join('asociacion_exam_dientes', function ($join) {
                        $join->on('asociacion_exam_dientes.diente_id', '=', 'dientes.id');
                    })->pluck('dientes.id')->values())->get();

        } elseif ($child == 0) {
            $dientes = Diente::where('dientes.patient_id', '=', $patient_id)
                ->where('number', '<', '50')
                ->whereNotIn('dientes.id', Diente::where('asociacion_exam_dientes.exam_id', '=', $exam_id)
                    ->where('dientes.patient_id', '=', $patient_id)
                    ->join('asociacion_exam_dientes', function ($join) {
                        $join->on('asociacion_exam_dientes.diente_id', '=', 'dientes.id');
                    })->pluck('dientes.id')->values())->get();
        }

        return view('asociacion_ExDiente_Periodoncia.create', ['exam_id' => $exam_id, 'dientes' => $dientes]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_asociacionED(Request $request, $exam_id)
    {
        $child = Patient::find(Exam::find($exam_id)->patient_id)->child;
        if ($child == 1) {
            $lista = array(51, 52, 53, 54, 55, 61, 62, 63, 64, 65, 71, 72, 73, 74, 75, 81, 82, 83, 84, 85);
        } else {
            $lista = array(11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48);
        }
        if (Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin' => ['required', 'string', 'max:191',new PinProfesor()]]);
            $user=User::where('pin','=',MD5($request->pin))->first();
        }

        foreach ($lista as $a) {
            $this->validate($request, [
                'denticionRaiz' . $a => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
                'denticionCorona' . $a => 'required|String|in:Sano,Cariado,Obturado,sin caries,Obturado,con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
                'opacidad' . $a => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
                'diente_id' . $a => 'required|exists:dientes,id',
                'tipo_tratamiento_id'.$a=>'required|exists:tipo_tratamientos,id'
            ]);

            $asociacion_exam_diente = new AsociacionExamDiente();
            $asociacion_exam_diente->denticionRaiz = $request->get('denticionRaiz' . $a);
            $asociacion_exam_diente->denticionCorona = $request->get('denticionCorona' . $a);
            $asociacion_exam_diente->opacidad = $request->get('opacidad' . $a);
            $asociacion_exam_diente->diente_id = $request->get('diente_id' . $a);
            $asociacion_exam_diente->exam_id = $exam_id;
            if(Auth::user()->userType=='student') {
                $asociacion_exam_diente->teacher_id = $user->id;
            }
            $asociacion_exam_diente->save();
            if($request->get('tipo_tratamiento_id' .$a)!=1){
                $tipo_tratamiento=TipoTratamiento::find($request->get('tipo_tratamiento_id' .$a));
                $tratamiento=new Tratamiento();
                $tratamiento->tipo_tratamiento_id=$request->get('tipo_tratamiento_id' .$a);
                $tratamiento->exam_id=$exam_id;
                $tratamiento->coste=$tipo_tratamiento->coste;
                $tratamiento->iva=$tipo_tratamiento->iva;
                $tratamiento->asociacion_exam_diente_id=$asociacion_exam_diente->id;
                $tratamiento->save();
            }
        }


        flash('Asociación creada correctamente');
        return redirect()->route('exams.show', [$exam_id]);
    }

    public function store_asociacionEDPeriodoncia(Request $request, $exam_id)
    {
        $child = Patient::find(Exam::find($exam_id)->patient_id)->child;
        if ($child == 1) {
            $lista = array(51, 52, 53, 54, 55, 61, 62, 63, 64, 65, 71, 72, 73, 74, 75, 81, 82, 83, 84, 85);
        } else {
            $lista = array(11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48);
        }
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin' => ['required', 'string', 'max:191',new PinProfesor()]]);
            $user=User::where('pin','=',MD5($request->pin))->first();
        }

        foreach ($lista as $a) {
            $this->validate($request, [
                'furca' . $a => 'required|Integer|max:10|min:-10',
                'retraccion' . $a => 'required|Integer|max:10|min:-10',
                'hipertrofia' . $a => 'required|Integer|max:10|min:-10',
                'sondaje' . $a => 'required|boolean',
                'movilidad' . $a => 'required|boolean',
                'sangrado' . $a => 'required|boolean',
                'encia_insertada' . $a => 'required|boolean',
                'diente_id' . $a => 'required|exists:dientes,id',
            ]);

            $asociacion_exam_diente = new AsociacionExamDiente();
            $asociacion_exam_diente->furca = $request->get('furca' . $a);
            $asociacion_exam_diente->retraccion = $request->get('retraccion' . $a);
            $asociacion_exam_diente->hipertrofia = $request->get('hipertrofia' . $a);
            $asociacion_exam_diente->sondaje = $request->get('sondaje' . $a);
            $asociacion_exam_diente->movilidad = $request->get('movilidad' . $a);
            $asociacion_exam_diente->sangrado = $request->get('sangrado' . $a);
            $asociacion_exam_diente->encia_insertada = $request->get('encia_insertada' . $a);
            $asociacion_exam_diente->diente_id = $request->get('diente_id' . $a);
            $asociacion_exam_diente->exam_id = $exam_id;
            if(Auth::user()->userType=='student') {
                $asociacion_exam_diente->teacher_id = $user->id;
            }
            $asociacion_exam_diente->save();
        }

        flash('Asociación creada correctamente');
        return redirect()->route('exams.show', [$exam_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Edit Student
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($exam_id)
    {

        $tipo_tratamientos=TipoTratamiento::all()->pluck('name','id');

        $asociacion_exam_dientes = AsociacionExamDiente::all()->where('exam_id','=',$exam_id);

        return view('asociacion_ExDiente/edit_asociacion_exam_diente', ['asociacion_exam_dientes' => $asociacion_exam_dientes,
            'tipo_tratamientos'=>$tipo_tratamientos]);
    }

    public function edit_asociacionEDPeriodoncia($exam_id)
    {
        $asociacion_exam_dientes = AsociacionExamDiente::all()->where('exam_id','=',$exam_id);
        return view('asociacion_ExDiente_Periodoncia/edit', ['asociacion_exam_dientes' => $asociacion_exam_dientes]);
    }


    /**
     * Update Student
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$exam_id)
    {
        $child = Patient::find(Exam::find($exam_id)->patient_id)->child;
        if ($child == 1) {
            $lista = array(51, 52, 53, 54, 55, 61, 62, 63, 64, 65, 71, 72, 73, 74, 75, 81, 82, 83, 84, 85);
        } else {
            $lista = array(11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48);
        }
        if (Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin' => ['required', 'string', 'max:191',new PinProfesor()]]);
            $user=User::where('pin','=',MD5($request->pin))->first();
        }
        foreach ($lista as $a) {
            $this->validate($request, [
               'denticionRaiz' . $a => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                    Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
                'denticionCorona' . $a => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado,con caries,Pérdida otro motivo,
                    Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
                'opacidad' . $a => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                    Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
                'asociacion_exam_diente_id' . $a => 'required|exists:asociacion_exam_dientes,id',
                'tipo_tratamiento_id' . $a => 'required|exists:tipo_tratamientos,id'
            ]);

            $asociacion_exam_diente = AsociacionExamDiente::find($request->get('asociacion_exam_diente_id'.$a));
            $tipo_tratamiento = TipoTratamiento::find($request->get('tipo_tratamiento_id'.$a));
            if ($request->get('tipo_tratamiento_id'.$a) != 1 && count($asociacion_exam_diente->tratamiento)== 0) {
                $tratamiento = new Tratamiento();
                $tratamiento->tipo_tratamiento_id = $request->get('tipo_tratamiento_id'.$a);
                $tratamiento->exam_id = $asociacion_exam_diente->exam_id;
                $tratamiento->coste = $tipo_tratamiento->coste;
                $tratamiento->iva = $tipo_tratamiento->iva;
                $tratamiento->asociacion_exam_diente_id = $asociacion_exam_diente->id;
                $tratamiento->save();
            } elseif ($request->get('tipo_tratamiento_id'.$a) != 1 && count($asociacion_exam_diente->tratamiento) > 0) {
                $tratamiento = Tratamiento::find($asociacion_exam_diente->tratamiento->first()->id);
                $tratamiento->tipo_tratamiento_id = $request->get('tipo_tratamiento_id'.$a);
                $tratamiento->exam_id = $asociacion_exam_diente->exam_id;
                $tratamiento->coste = $tipo_tratamiento->coste;
                $tratamiento->iva = $tipo_tratamiento->iva;
                $tratamiento->asociacion_exam_diente_id = $asociacion_exam_diente->id;
                $tratamiento->save();
            }
            if (Auth::user()->userType=='student'){
                $asociacion_exam_diente->teacher_id = $user->id;
            }
            $asociacion_exam_diente->denticionRaiz = $request->get('denticionRaiz' . $a);
            $asociacion_exam_diente->denticionCorona = $request->get('denticionCorona' . $a);
            $asociacion_exam_diente->opacidad = $request->get('opacidad' . $a);
            $asociacion_exam_diente->save();

        }


        flash('Asociación editada correctamente');

        return redirect()->route('exams.show', [$asociacion_exam_diente->exam_id]);

    }

    public function update_asociacionEDPeriodoncia(Request $request, $exam_id)
    {
        $child = Patient::find(Exam::find($exam_id)->patient_id)->child;
        if ($child == 1) {
            $lista = array(51, 52, 53, 54, 55, 61, 62, 63, 64, 65, 71, 72, 73, 74, 75, 81, 82, 83, 84, 85);
        } else {
            $lista = array(11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48);
        }
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin' => ['required', 'string', 'max:191',new PinProfesor()]]);
            $user=User::where('pin','=',MD5($request->pin))->first();
        }

        foreach ($lista as $a) {
            $this->validate($request, [
                'furca' . $a => 'required|Integer|max:10|min:-10',
                'retraccion' . $a => 'required|Integer|max:10|min:-10',
                'hipertrofia' . $a => 'required|Integer|max:10|min:-10',
                'sondaje' . $a => 'required|boolean',
                'movilidad' . $a => 'required|boolean',
                'sangrado' . $a => 'required|boolean',
                'encia_insertada' . $a => 'required|boolean',
            ]);

            $asociacion_exam_diente = AsociacionExamDiente::find($request->get("asociacion_exam_diente_id".$a));
            $asociacion_exam_diente->furca = $request->get('furca' . $a);
            $asociacion_exam_diente->retraccion = $request->get('retraccion' . $a);
            $asociacion_exam_diente->hipertrofia = $request->get('hipertrofia' . $a);
            $asociacion_exam_diente->sondaje = $request->get('sondaje' . $a);
            $asociacion_exam_diente->movilidad = $request->get('movilidad' . $a);
            $asociacion_exam_diente->sangrado = $request->get('sangrado' . $a);
            $asociacion_exam_diente->encia_insertada = $request->get('encia_insertada' . $a);
            if(Auth::user()->userType=='student') {
                $asociacion_exam_diente->teacher_id = $user->id;
            }
            $asociacion_exam_diente->save();
        }

        flash('Asociación creada correctamente');
        return redirect()->route('exams.show', [$exam_id]);


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
