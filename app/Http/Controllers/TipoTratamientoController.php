<?php

namespace App\Http\Controllers;

use App\Braket;
use App\Diagnostico;
use App\Diente;
use App\TipoDiagnostico;
use App\TipoTratamiento;
use App\Tratamiento;
use Illuminate\Http\Request;

class TipoTratamientoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->semibutton=='Borrar filtro') {
            \Cookie::queue('query_tipo_trat', null, 60);
            $query_tipo_trat=null;
        }else {
            if ($request->get("query_tipo_trat") != null) {
                $this->validate($request,[
                    'query_tipo_trat' => ['string',  'max:50'],
                ]);
                \Cookie::queue('query_tipo_trat', $request->get("query_tipo_trat"), 60);
                $query_tipo_trat = $request->get("query_tipo_trat");
            } else {
                $query_tipo_trat = \Request::cookie('query_tipo_trat');
            }
        }

        $tipo_tratamientos=TipoTratamiento::where('tipo_tratamientos.name','LIKE','%'.$query_tipo_trat."%")
                ->paginate(20);
        return view('tipo_tratamientos/index',['tipo_tratamientos'=>$tipo_tratamientos,'query_tipo_trat'=>$query_tipo_trat]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('tipo_tratamientos/create');
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
            'name' => ['required', 'string', 'max:191'],
            'coste' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],
            'iva' =>  ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],

        ]);

        $tipo_tratamientos=new TipoTratamiento($request->all());
        $tipo_tratamientos->save();

        flash('Tratamiento creado correctamente');

        return redirect()->route('tipo_tratamientos.index');
    }
    /**
     * Edit Student
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_tratamiento = TipoTratamiento::find($id);
        return view('tipo_tratamientos/edit',['tipo_tratamiento'=> $tipo_tratamiento]);
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
            'name' => ['required', 'string', 'max:191'],
            'coste' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],
            'iva' =>  ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/', 'max:100','min:0'],

        ]);

        $tipo_tratamiento = TipoTratamiento::find($id);
        $tipo_tratamiento->fill($request->all());
        $tipo_tratamiento->save();

        flash('Tratamiento creado correctamente');

        return redirect()->route('tipo_tratamientos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_tratamiento = TipoTratamiento::find($id);
        $tipo_tratamiento->delete();
        flash('Tratamiento borrado correctamente');

        return redirect()->route('tipo_tratamientos.index');
    }

}
