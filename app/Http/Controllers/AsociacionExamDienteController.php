<?php

namespace App\Http\Controllers;

use App\AsociacionExamDiente;
use App\Diente;
use App\Exam;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Void_;

class AsociacionExamDienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($exam_id)
    {
        $asociacion_exam_dientes=AsociacionExamDiente::all()->where('exam_id','=',$exam_id);

        return view('exams.asociacion_exam_diente',['asociacion_exam_dientes'=>$asociacion_exam_dientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_asociacionED($exam_id)
    {
        $exam=Exam::find($exam_id);
        $patient_id=$exam->patient_id;
        $patient=Patient::find($patient_id);
        $child=$patient->child;
        if($child==1){
           /**
            DB::raw('select * from laravel.dientes
                where laravel.dientes.patient_id=1 and
                laravel.dientes.id not in (SELECT laravel.dientes.id FROM laravel.dientes
                LEFT JOIN laravel.asociacion_exam_dientes
                ON (laravel.dientes.id=laravel.asociacion_exam_dientes.diente_id)
                WHERE laravel.asociacion_exam_dientes.exam_id=1 and laravel.dientes.patient_id=1) ');
            */

            $diente = DB::table('dientes')
                ->join('asociacion_exam_dientes','asociacion_exam_dientes.diente_id','=','dientes.id')
                ->where('asociacion_exam_dientes.exam_id','=',$exam_id)
                ->where('dientes.patient_id','=',$patient_id)
                ->select('dientes.id')
                ->get();

            if(count($diente)==0){
                $dientes=Diente::all()
                    ->where('patient_id','=',$patient_id)
                    ->where('number','>','50')
                    ->pluck('number', 'id');

            }else{
                $dientes=Diente::all()
                    ->where('patient_id','=',$patient_id)
                    ->where('number','>','50')
                    ->whereNotIn('dientes.id',$diente)
                    ->pluck('number', 'id');
            }

        }elseif($child==0){
            /**$diente = DB::table('asociacion_exam_dientes')
                ->where('exam_id','=',$exam_id)
                ->join('dientes','dientes.id','!=','asociacion_exam_dientes.diente_id')
                ->select('dientes.*')
                ->get();
             */
            $diente = DB::table('dientes')
                ->join('asociacion_exam_dientes','asociacion_exam_dientes.diente_id','=','dientes.id')
                ->where('asociacion_exam_dientes.exam_id','=',$exam_id)
                ->where('dientes.patient_id','=',$patient_id)
                ->select('dientes.id')
                ->get();
            if(count($diente)==0){
                $dientes=Diente::all()
                    ->where('number','<','50')
                    ->where('patient_id','=',$patient_id)
                    ->pluck('number', 'id');
            }else{
                $dientes=$diente
                    ->where('patient_id','=',$patient_id)
                    ->where('number','<','50')
                    ->pluck('number', 'id');
            }
        }


        return view('exams.create_asociacion_exam_diente',['exam_id'=>$exam_id,'dientes'=>$dientes]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_asociacionED(Request $request,$exam_id)
    {
        $this->validate($request, [
            'denticionRaiz' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'denticionCorona' => 'required|String|in:Sano,Cariado,Obturado,sin caries,Obturado,con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'tratamiento' => 'required|String|in:Ninguno,Preventivo,Obturación de fisuras,Obt. 1 o mas superficies,Obt 2 o mas superficies,Corona,Carilla estética,Tratamiento pulgar,Exodoncia,No registrado',
            'opacidad' => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
            'diente_id' => 'required|exists:dientes,id',

        ]);

        $asociacion_exam_diente=new AsociacionExamDiente();
        $asociacion_exam_diente->denticionRaiz= $request->get('denticionRaiz');
        $asociacion_exam_diente->denticionCorona= $request->get('denticionCorona');
        $asociacion_exam_diente->tratamiento= $request->get('tratamiento');
        $asociacion_exam_diente->opacidad= $request->get('opacidad');
        $asociacion_exam_diente->diente_id= $request->get('diente_id');
        $asociacion_exam_diente->exam_id=$exam_id;
        $asociacion_exam_diente->save();


        flash('Asociación creada correctamente');

        switch($request->submitbutton) {
            case 'Guardar':
                return redirect()->route('create_asociacionED',[$exam_id]);
                break;
            case 'Terminar':
                return redirect()->route('exams.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asociacion_exam_diente = AsociacionExamDiente::find($id);

        $diente = DB::table('asociacion_exam_dientes')
            //  ->where('exam_id','=',$exam_id)
            ->join('dientes','dientes.id','!=','asociacion_exam_dientes.diente_id')
            ->select('dientes.*')
            ->get();
        $dientes=$diente->pluck('name', 'id');

        return view('exams.edit_asociacion_exam_diente',['asociacion_exam_diente'=> $asociacion_exam_diente,'dientes'=>$dientes ]);
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
            'denticionRaiz' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'denticionCorona' => 'required|String|in:Sano,Cariado,Obturado sin caries,Obturado con caries,Pérdida otro motivo,
                Fisura Obturada,Pilar puente/corona,Diente no erupcionado,Fractura',
            'tratamiento' => 'required|String|in:Ninguno,Preventivo,Obturación de fisuras,Obt. 1 o mas superficies,Obt 2 o mas superficies,
                Corona,Carilla estética,Tratamiento pulgar,Exodoncia,No registrado',
            'opacidad' => 'required|String|in:Ningún estado anormal,Opacidad delimitada,OpacidadDifusa,Hipoplasia,
                Otros defectos,Opacidad elimitada y difusa,Opacidad delimitada e hipoplasia,Opacidad difusa e hipoplasia',
            'diente_id' => 'required|exists:dientes,id',
        ]);

        $asociacion_exam_diente = AsociacionExamDiente::find($id);
        $asociacion_exam_diente->fill($request->all());
        $asociacion_exam_diente->save();

        flash('Asociación editada correctamente');

        return redirect()->route('index_asociacionED',[$asociacion_exam_diente->exam_id]);

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
