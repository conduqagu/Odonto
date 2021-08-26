<?php

namespace App\Http\Controllers;

use App\Braket;
use App\Diagnostico;
use App\Exam;
use App\Rules\PinProfesor;
use App\TipoTratamiento;
use App\Tratamiento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TratamientoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamientos=Tratamiento::all();
        return view('tratamientos/index',['tratamientos'=>$tratamientos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createT($exam_id)
    {
        $tipo_tratamientos=TipoTratamiento::all()->pluck('name','id');
        $brakets=Braket::all()->pluck('name','id');
        return view('tratamientos/create',['brakets'=>$brakets,'tipo_tratamientos'=>$tipo_tratamientos,'exam_id'=>$exam_id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->fecha_fin!=null){
            $this->validate($request, [
                'fecha_inicio' => ['required', 'date'],
                'fecha_fin' => ['nullable', 'date','after_or_equal:fecha_inicio']
            ]);
        }else{
            $this->validate($request, [
                'fecha_inicio' => ['nullable', 'date'],
                'fecha_fin' => ['nullable', 'date','after_or_equal:fecha_inicio']
            ]);
        }
        $this->validate($request, [
            'terapia' => ['required', 'string', 'in:sin definir,convencional,fases'],
            'tipo_tratamiento_id' => ['required', 'exists:tipo_tratamientos,id'],
            'exam_id' =>['required','exists:exams,id']
        ]);

        if(Exam::find($request->exam_id)->tipoExam=='ortodoncial'){
        $this->validate($request, [
            'braket_id' => ['required', 'exists:brakets,id'],
        ]);
        }
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin'=>['required','string','max:191',new PinProfesor()]]);

        }
        $tratamiento=new Tratamiento($request->all());
        $tratamiento->save();
        $tratamiento->coste=$tratamiento->tipoTratamiento->coste;
        $tratamiento->iva=$tratamiento->tipoTratamiento->iva;
        $tratamiento->save();

        flash('Tratamiento creado correctamente');

        return redirect()->route('exams.show',$request->exam_id);

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
        $tratamiento = Tratamiento::find($id);

        $tipo_tratamientos = TipoTratamiento::all()->pluck('name','id');
        $brakets=Braket::all()->pluck('name','id');
        return view('tratamientos.edit',['tratamiento'=> $tratamiento, 'tipo_tratamientos'=>$tipo_tratamientos,'brakets'=>$brakets ]);
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
        if($request->fecha_fin!=null){
            $this->validate($request, [
                'fecha_inicio' => ['required', 'date'],
                'fecha_fin' => ['nullable', 'date','after_or_equal:fecha_inicio']
            ]);
        }else{
            $this->validate($request, [
                'fecha_inicio' => ['nullable', 'date'],
                'fecha_fin' => ['nullable', 'date','after_or_equal:fecha_inicio']
            ]);
        }
        $this->validate($request, [
            'terapia' => ['required', 'string', 'in:sin definir,convencional,fases'],
            'tipo_tratamiento_id' => ['required', 'exists:tipo_tratamientos,id'],
        ]);
        $tratamiento = Tratamiento::find($id);

        if(Exam::find($tratamiento->exam_id)->tipoExam=='ortodoncial'){
            $this->validate($request, [
                'braket_id' => ['required', 'exists:brakets,id'],
            ]);
        }
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin' => ['required', 'string', 'max:191']]);
            $profesores=User::find(Auth::user()->id)->teachers()
                ->where('pin','=',MD5($request->pin))->get();

            if(count($profesores)==0) {
                flash('Pin incorrecto');
                return redirect()->back();
            }
        }

        $tratamiento->fill($request->all());
        $tratamiento->save();
        $tratamiento->coste=$tratamiento->tipoTratamiento->coste;
        $tratamiento->iva=$tratamiento->tipoTratamiento->iva;
        $tratamiento->save();

        flash('Diente modificado correctamente');

        return redirect()->route('exams.show',$tratamiento->exam_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tratamiento = Tratamiento::find($id);
        $exam_id=$tratamiento->exam_id;
        $tratamiento->delete();
        flash('Tratamiento borrado correctamente');

        return redirect()->route('exams.show',$exam_id);
    }
}
