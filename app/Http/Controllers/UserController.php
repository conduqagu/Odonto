<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AsociacionTeacherStudent;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexstudents() //Lista de estudiantes para profesores
    {
        $students = DB::table('users')->where('userType','=','student')->get();
        return view('indexstudents',['students'=>$students]);
    }
    public function listsmystudent() //Lista de estudiantes para profesores
    {
        $students = DB::table('asociacion_teacher_students')
            ->where('teacher_id','=',Auth::user()->id)
            ->join('users', 'users.id', '=', 'asociacion_teacher_students.student_id')
            ->select('users.*')
            ->get();
        return view('listsmystudent',['students'=>$students]);
    }

    public function asignaralumno($id)
    {
        $asociacion_teacher_student=new AsociacionTeacherStudent();
        $asociacion_teacher_student->teacher_id= Auth::user()->id;
        $asociacion_teacher_student->student_id=$id;
        $asociacion_teacher_student->save();

        flash('Alumno asignado correctamente');

        return redirect()->route('indexstudents');
    }

    public function destroyasociacion($id)
    {
        $students = DB::table('asociacion_teacher_students')
            ->where('teacher_id','=',Auth::user()->id)
            ->where('student_id','=',$id)
            ->select('asociacion_teacher_students.id')
            ->get();
        $asociacion_teacher_student=AsociacionTeacherStudent::find($students[0]->id);

        $asociacion_teacher_student->delete();

        flash('Alumno quitado correctamente');

        return redirect()->route('listsmystudent');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
