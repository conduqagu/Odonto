<?php

namespace App\Http\Controllers;

use App\Braket;
use App\Diagnostico;
use App\TipoTratamiento;
use App\Tratamiento;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'coste' => ['required', 'integer', 'max:255'],
            'terapia' => ['required', 'string', 'in:sin definir,convencional,fases'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'braket_id' => ['nullable', 'exists:brakets,id'],
            'tipo_tratamiento_id' => ['required', 'exists:tipo_tratamientos,id'],
            'exam_id' =>['required','exists:exams,id']
        ]);
        $tratamientos=new Tratamiento($request->all());
        $tratamientos->save();
        flash('Tratamiento creado correctamente');

        switch($request->submitbutton) {
            case 'Guardar':
                return redirect()->route('exams.show',$request->exam_id);
                break;
            case 'Añadir tratamiento':
                return redirect()->route('tratamientos.createT',$tratamientos->exam_id);
                break;
        }
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
        $this->validate($request, [
            'coste' => ['required', 'integer', 'max:255'],
            'terapia' => ['required', 'string', 'in:sin definir,convencional,fases'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'braket_id' => ['nullable', 'exists:brakets,id'],
            'tipo_tratamiento_id' => ['required', 'exists:tipo_tratamientos,id'],
        ]);

        $tratamiento = Tratamiento::find($id);
        $tratamiento->fill($request->all());

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
