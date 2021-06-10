<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AsociacionTeacherStudent;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Lista de usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all()->whereNotIn('id',Auth::user()->id);

        return view('perfiles/index',['users'=>$users]);
    }

    /**
     * Lista de estudiantes no asignados al profesor (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexstudents(Request $request) //Lista de estudiantes para profesores
    {

        $students= \App\User::whereNotIn('users.id',\App\User::find(Auth::user()->id)->students()->pluck('users.id')->values())
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
    public function listsmystudent(Request $request) //Lista de estudiantes para profesores
    {
        $students = \App\User::find(Auth::user()->id)->students()
            ->where('users.name','LIKE','%'.$request->get("query")."%")
            ->where('userType','=','student')
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
        $teacher = User::find(Auth::user()->id);
        $teacher->students()->attach($id);

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
        $teacher = User::find(Auth::user()->id);
        $teacher->students()->detach($id);


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
        return view('perfiles/register');

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
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required', 'string','max:255'],
            'dni' => ['required','unique:users','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'userType'=> ['required', 'string','in:student,teacher,admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user=new \App\User($request->all());
        if($request->userType=='teacher'){
            $user->pin=MD5($request->dni);
        }
        $user->password=Hash::make($request->get('password'));
        $user->save();

        flash('Usuario creado correctamente');

        if(Auth::user()->userType=='admin'){
            return redirect()->route('userIndex');
        }else{
            @flash('Usuario creado correctamente');
            return redirect()->route('home');
        }

    }

    /**
     * Listado de profesores asignados a un alumno (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function perfilstudent(){
        $user=Auth::user();
        $teachers=$user->teachers;
        return view('perfiles/perfilstudent',['user'=>$user,'teachers'=>$teachers]);
    }
    /**
     * Editar datos del alumno (usuario)
     *
     * @param id_alumno
     * @return \Illuminate\Http\Response
     */
    public function updateperfilstudent(Request $request, $id){
        $user=\App\User::find($id);

        if($request->email==$user->email){
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }


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
        $user=\App\User::find($id);

        if($request->email==$user->email){
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        $this->validate($request, [
            'oldpin'=>['nullable','string'],
            'pin'=>['nullable','string', 'unique:users'],
            'confirmpin'=>['nullable','string'],
        ]);
        $user->email=$request->get('email');
        if ($user->pin==MD5($request->oldpin)){
            if($request->pin==$request->confirmpin){
                $user->pin=MD5($request->pin);
                flash('Datos actualizados correctamente');
            }else{
                flash('¡ERROR! Nuevo pin y confirmación de pin no coinciden');
            }
        }else{
            flash('Pin no actualizado');
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
        $user=User::find($id);
        if($request->email==$user->email){
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        if($request->dni==$user->dni){
            $this->validate($request,[
                'dni' => ['required','string','max:255'],
            ]);
        }else{
            $this->validate($request,[
                'dni' => ['required','unique:users','string','max:255'],
            ]);
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required', 'string','max:255'],
        ]);

        $user->fill($request->all());
        $user->save();

        flash('Datos actualizados correctamente');

        return redirect()->route('perfiladmin');
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
        $user = User::find($id);

        return view('perfiles.edit',['user'=>$user]);
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
        $user=User::find($id);
        if($request->email==$user->email){
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        if($request->dni==$user->dni){
            $this->validate($request,[
                'dni' => ['required','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            ]);
        }else{
            $this->validate($request,[
                'dni' => ['required','unique:users','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            ]);
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required', 'string','max:255'],
            'userType'=> ['required', 'string','in:student,teacher,admin'],
        ]);

        $user->fill($request->all());
        $user->save();

        flash('Usuario modiifcado correctamente');
        return redirect()->route('userIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        flash('Usuario borrado correctamente');

        return redirect()->route('userIndex');
    }
}
