<?php

namespace App\Http\Controllers;

use App\AsociacionExamDiente;
use Illuminate\Http\Request;

class AsociacionExamDienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asociacion_exam_diente=AsociacionExamDiente::all();
        return view('asociacion_exam_dientes.index',['asociacion_exam_diente'=>$asociacion_exam_diente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::all()->pluck('date','id');
        $diente = Diente::all()->pluck('name','id');


        return view('asociacion_exam_dientes.create',['exams'=>$exams,'diente'=>$diente]);
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
            'denticionRaiz' => 'required|String|in:Sano,Cariado,Obturado,sin caries,Obturado,con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'denticionCorona' => 'required|String|in:Sano,Cariado,Obturado,sin caries,Obturado,con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'tratamiento' => 'required|String|in: Ninguno,Preventivo,Obturación de fisuras,Obt. 1 o mas superficies,Obt 2 o mas superficies,
                Corona,Carilla estética,Tratamiento pulgar,Exodoncia,No registrado',
            'opacidad' => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
            'exam_id' => 'required|exists:exams,id',
            'diente_id' => 'required|exists:dientes,id',

        ]);
        $asociacion_exam_diente = new AsociacionExamDiente($request->all());
        $asociacion_exam_diente->save();

        flash('Asociación creada correctamente');

        return redirect()->route('asociacion_exam_dientes.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asociacion_exam_diente = AsociacionExamDiente::find($id);

        return view('asociacion_exam_dientes.edit',['asociacion_exam_diente'=> $asociacion_exam_diente ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'denticionRaiz' => 'required|String|in:Sano,Cariado,Obturado,sin caries,Obturado,con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'denticionCorona' => 'required|String|in:Sano,Cariado,Obturado,sin caries,Obturado,con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'tratamiento' => 'required|String|in: Ninguno,Preventivo,Obturación de fisuras,Obt. 1 o mas superficies,Obt 2 o mas superficies,
                Corona,Carilla estética,Tratamiento pulgar,Exodoncia,No registrado',
            'opacidad' => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
            'exam_id' => 'required|exists:exams,id',
            'diente_id' => 'required|exists:dientes,id',

        ]);
        $asociacion_exam_diente = Diente::find($id);
        $asociacion_exam_diente->fill($request->all());
        $asociacion_exam_diente->save();

        flash('Asociación editada correctamente');

        return redirect()->route('asociacion_exam_dientes.index');

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

        return redirect()->route('asociacion_exam_dientes.index');

    }
}
