<?php

namespace App\Http\Controllers;

use App\Diente;
use Illuminate\Http\Request;

class DienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     */
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
        return Validator::make($data, [
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
    public function store(Request $request)
    {
        $this ->validator($request);
        $diente = new Diente($this->all());
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
        return view('diente.profile', ['diente' => Diente::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
