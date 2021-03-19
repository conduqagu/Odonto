<?php

namespace App\Http\Controllers;

use App\Diagnostico;
use App\Diente;
use App\TipoDiagnostico;
use Illuminate\Http\Request;

class AjusteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajustes.index');

    }

}
