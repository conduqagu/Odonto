<?php

namespace App\Http\Controllers;

use App\Diagnostico;
use App\Diente;
use App\Exam;
use App\Rules\PinProfesor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosticoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->semibutton=='Borrar filtro') {
            \Cookie::queue('query_diag', null, 60);
            $query_diag=null;
        }else {
            if ($request->get("query_diag") != null) {
                $this->validate($request, [
                    'query_diag' => ['string', 'max:50'],
                ]);
                \Cookie::queue('query_diag', $request->get("query_diag"), 60);
                $query_diag = $request->get("query_diag");
            } else {
                $query_diag = \Request::cookie('query_diag');
            }
        }

        $diagnosticos=Diagnostico::where('diagnosticos.nombre','LIKE','%'.$query_diag."%")->paginate(20);

        return view('diagnosticos.index',['diagnosticos'=>$diagnosticos,'query_diag'=>$query_diag]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('diagnosticos.create');
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
            'nombre' => ['required', 'string', 'max:100'],
        ]);

        $diagnosticos=new Diagnostico($request->all());
        $diagnosticos->save();

        flash('Diagnostico creado correctamente');

        return redirect()->route('diagnosticos.index');
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
        $diagnostico = Diagnostico::find($id);
        return view('diagnosticos.edit',['diagnostico'=> $diagnostico]);
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
            'nombre' => ['required', 'string', 'max:100'],

        ]);
        $diagnostico = Diagnostico::find($id);
        $diagnostico->fill($request->all());
        $diagnostico->save();

        flash('Diagnóstico creado correctamente');

        return redirect()->route('diagnosticos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnostico = Diagnostico::find($id);
        $diagnostico->delete();
        flash('Diagnostico borrado correctamente');

        return redirect()->route('diagnosticos.index');
    }

    public function create_asociacion_diagnostico_exam($exam_id)
    {
        $diagnosticos_examen=Exam::find($exam_id)->diagnosticos()->get()->pluck('id','id');
        $diagnosticos=Diagnostico::all()->whereNotIn('id',$diagnosticos_examen)->pluck('nombre','id');
        return view('asociacion_ExDiags/create',['exam_id'=>$exam_id,'diagnosticos'=>$diagnosticos]);
    }
    public function store_asociacion_diagnostico_exam(Request $request,$exam_id)
    {
        $this->validate($request, [
            'diagnostico_id' => 'required|exists:diagnosticos,id',
            'comentario'=>['nullable', 'string', 'max:191'],
        ]);
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin' => ['required', 'string', 'max:191',new PinProfesor()]]);
        }
        $exam=Exam::find($exam_id);
        $exam->diagnosticos()->attach($request->diagnostico_id, array('comentario'=>$request->comentario));


        flash('Asociación creada correctamente');

        return redirect()->route('exams.show',$exam_id);

    }
    public function destroy_asociacion_diagnostico_exam($diagnostico_id,Request $request)
    {
        $exam=Exam::find($request->exam_id);
        $exam->diagnosticos()->detach($diagnostico_id);

        flash('Diagnostico borrado correctamente');

        return redirect()->route('exams.show',$request->exam_id);
    }

}
