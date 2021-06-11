<?php

namespace App\Http\Controllers;

use App\PruebaComplementaria;
use App\Rules\PinProfesor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PruebaComplementariaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($exam_id)
    {
        return view('prueba_complementarias.create',['exam_id'=>$exam_id]);
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
            'nombre' => ['required', 'string', 'max:255'],
            'comentario' => ['nullable', 'string', 'max:255'],
            'exam_id' => ['required', 'exists:exams,id'],
        ]);
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin'=>['required','string','max:255',new PinProfesor()]]);

        }
        $prueba_complementaria=new PruebaComplementaria($request->all());
        $prueba_complementaria->save();

        if ($request->hasFile('fichero')) {
            $file = $request->file('fichero');
            $fileName = $file->getClientOriginalName();
            $path = $request->file('fichero')->storeAs(
                $prueba_complementaria->id, $fileName, 'pruebas'
            );
            $prueba_complementaria->fichero = 'pruebas/'.$prueba_complementaria->id.'/'.$fileName;
        }

        $prueba_complementaria->save();

        flash('Prueba añadida correctamente');

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
        $prueba_complementaria=PruebaComplementaria::find($id);
        return view('prueba_complementarias.edit',['prueba_complementaria'=>$prueba_complementaria]);
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
            'nombre' => ['required', 'string', 'max:255'],
            'fichero' => ['required', 'string', 'max:255'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);
        if(Auth::user()->userType=='student'){
            $this->validate($request,
                ['pin'=>['required','string','max:255',new PinProfesor()]]);

        }

        $prueba_complementaria = PruebaComplementaria::find($id);
        $prueba_complementaria->fill($request->all());
        $prueba_complementaria->save();

        flash('Peueba creada correctamente');

        return redirect()->route('exams.show',$prueba_complementaria->exam_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prueba_complementaria = PruebaComplementaria::find($id);
        $exam_id=$prueba_complementaria->exam_id;
        $prueba_complementaria->delete();
        flash('Prueba borrada correctamente');

        return redirect()->route('exams.show',$exam_id);
    }
}
