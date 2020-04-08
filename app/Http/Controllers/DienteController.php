<?php

namespace App\Http\Controllers;

use App\Diente;
use Illuminate\Http\Request;

class DienteController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Handle the incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function __invoke(Request $request)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dientes=Diente::all();
        return view('dientes.index',['dientes'=>$dientes]);
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
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'max:100'],
            'cuadrante' => ['required', 'integer','max:4' ],
            'sextante' => ['required', 'integer','max:6' ],


        ]);
    }
    /**
     * Create a new diente instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Diente
     */
    public function create(array $data)
    {
        return Diente::create([
            'name' => $data['name'],
            'number' => $data['number'],
            'cuadrante'=>$data['cuadrante'],
            'sextante' => $data['sextante'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $request)
    {
        $this ->validator($request);
        $diente = new Diente($request->all());
        $diente->save();

        flash('Diente creado correctamente');

        return redirect()->route('dientes.index');
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
        $diente = Diente::find($id);

        return View::make('diente.edit')->with('diente', $diente);
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
        $this->validator($request);

        $diente = Diente::find($id);
        $diente->fill($request->all());

        $diente->save();

        flash('Diente modificado correctamente');

        return redirect()->route('dientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diente = Diente::find($id);
        $diente->delete();
        flash('Diente borrado correctamente');

        return redirect()->route('dientes.index');
    }
}
