<?php

namespace App\Http\Controllers;

use App\Diente;
use Illuminate\Http\Request;

class DienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    protected function create(array $data)
    {
        return Diente::create([
            'name' => $data['name'],
            'number' => $data['number'],
            'cuadrante'=>$data['cuadrante'],
            'sextante' => $data['sextante'],
        ]);
    }
}
