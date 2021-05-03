<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AsociacionTeacherStudent;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    /**
     * Lista de estudiantes no asignados al profesor (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexstudents(Request $request) //Lista de estudiantes para profesores
    {

        $students= \App\User::whereNotIn('users.id',
                AsociacionTeacherStudent::where('teacher_id','=',Auth::user()->id)
                    ->join('users','users.id','=','asociacion_teacher_students.student_id')
                    ->pluck('users.id')->values()
                )
            ->where('users.name','LIKE','%'.$request->get("query")."%")
            ->where('userType','=','student')
            ->get();

        return view('indexstudents',['students'=>$students]);
    }
    /**
     * Lista de estudiantes asociada a un profesor (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function listsmystudent() //Lista de estudiantes para profesores
    {
        $students = DB::table('asociacion_teacher_students')
            ->where('teacher_id','=',Auth::user()->id)
            ->join('users', 'users.id', '=', 'asociacion_teacher_students.student_id')
            ->select('users.*')
            ->get();
        return view('listsmystudent',['students'=>$students]);
    }
    /**
     * Asignar un alumno al profesor (usuario)
     *
     * @param id_alumno
     * @return \Illuminate\Http\Response
     */
    public function asignaralumno($id)
    {
        $asociacion_teacher_student=new AsociacionTeacherStudent();
        $asociacion_teacher_student->teacher_id= Auth::user()->id;
        $asociacion_teacher_student->student_id=$id;
        $asociacion_teacher_student->save();

        flash('Alumno asignado correctamente');

        return redirect()->route('indexstudents');
    }

    /**
     * Quitar asignacion de un alumno al profesor (usuario)
     *
     * @param id_alumno
     * @return \Illuminate\Http\Response
     */
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
     * Listado de profesores asignados a un alumno (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function perfilstudent(){
        $user=Auth::user();
        $teachers = DB::table('asociacion_teacher_students')
            ->where('student_id','=',Auth::user()->id)
            ->join('users', 'users.id', '=', 'asociacion_teacher_students.teacher_id')
            ->select('users.*')
            ->get();
        return view('perfiles/perfilstudent',['user'=>$user,'teachers'=>$teachers]);
    }
    /**
     * Editar datos del alumno (usuario)
     *
     * @param id_alumno
     * @return \Illuminate\Http\Response
     */
    public function updateperfilstudent(Request $request, $id){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required','string','max:255'],
            'email'=>['required','string','max:255'],
            'dni'=>['required','string','max:255']
        ]);

        $user=\App\User::find($id);
        $user->name=$request->get('name');
        $user->surname=$request->get('surname');
        $user->email=$request->get('email');
        $user->dni=$request->get('dni');

        $user->save();

        flash('Datos actualizados correctamente');
        return redirect()->route('perfilstudent');
    }
    /**
     * Mostar datos del profesor (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function perfilteacher(){
        $user=Auth::user();
        return view('perfiles/perfilteacher',['user'=>$user]);
    }
    /**
     * Editar datos del profesor (usuario)
     *
     * @param id_profesor
     * @return \Illuminate\Http\Response
     */
    public function updateperfilteacher(Request $request, $id){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required','string','max:255'],
            'email'=>['required','string','max:255'],
            'dni'=>['required','string','max:255'],
            'oldpin'=>['nullable','string'],
            'pin'=>['nullable','string', 'unique:users'],
            'confirmpin'=>['nullable','string']
        ]);

        $user=\App\User::find($id);
        $user->name=$request->get('name');
        $user->surname=$request->get('surname');
        $user->email=$request->get('email');
        $user->dni=$request->get('dni');
        if ($user->pin==Hash::make($request->oldpin)){
            if($request->pin==$request->confirmpin){
                $user->pin=Hash::make($request->pin);
                flash('Datos actualizados correctamente');
            }else{
                flash('¡ERROR! Nuevo pin y confirmación de pin no coinciden');
            }
        }else{
            flash('Pin no actualizado, el resto de datos se han actualizado correctamente');
        }
        $user->save();

        return redirect()->route('perfilteacher');
    }

    /**
     * Mostar datos del admin (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function perfiladmin(){
        $user=Auth::user();
        return view('perfiles/perfiladmin',['user'=>$user]);
    }
    /**
     * Editar datos del profesor (usuario)
     *
     * @param id_profesor
     * @return \Illuminate\Http\Response
     */
    public function updateperfiladmin(Request $request, $id){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required','string','max:255'],
            'email'=>['required','string','max:255'],
            'dni'=>['required','string','max:255'],
        ]);

        $user=\App\User::find($id);
        $user->name=$request->get('name');
        $user->surname=$request->get('surname');
        $user->email=$request->get('email');
        $user->dni=$request->get('dni');
        $user->save();

        flash('Datos actializados correctamente');

        return redirect()->route('perfiladmin');
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
