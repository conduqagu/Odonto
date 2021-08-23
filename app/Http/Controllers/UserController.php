<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AsociacionTeacherStudent;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Lista de usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->semibutton=='Borrar filtro') {
            \Cookie::queue('query_user', null, 60);
            $query_user=null;
        }else {
            if ($request->get("query_user") != null) {
                $this->validate($request,[
                    'query_user' => ['string',  'max:50'],
                ]);
                \Cookie::queue('query_user', $request->get("query_user"), 60);
                $query_user = $request->get("query_user");
            } else {
                $query_user = \Request::cookie('query_user');
            }
        }
        $user_filter=User::where('users.surname','LIKE','%'.$query_user."%")
            ->orWhere('users.name','LIKE','%'.$query_user."%")
            ->orWhere('users.dni','LIKE','%'.$query_user."%")->pluck('id','id');
        $users = User::whereNotIn('id',[Auth::user()->id])
            ->whereIn('id',$user_filter)
            ->paginate(20);

        return view('perfiles/index',['users'=>$users,'query_user'=>$query_user]);
    }

    /**
     * Lista de estudiantes no asignados al profesor (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexstudents(Request $request, $id) //Lista de estudiantes para profesores
    {
        if($request->semibutton=='Borrar filtro') {
            \Cookie::queue('query_students', null, 60);
            $query_students=null;
        }else {
            if ($request->get("query_students") != null) {
                \Cookie::queue('query_students', $request->get("query_students"), 60);
                $query_students = $request->get("query_students");
            } else {
                $query_students = \Request::cookie('query_students');
            }
        }
        $users_filter=User::where('users.name','LIKE','%'.$query_students."%")
        ->orWhere('users.dni','LIKE','%'.$query_students."%")
        ->orWhere('users.surname','LIKE','%'.$query_students."%")->pluck('id','id');
        $mystudents = \App\User::find($id)->students()
            ->whereIn('users.id',$users_filter)
            ->get();
        $students= User::where('userType','=','student')
            ->whereNotIn('users.id',\App\User::find($id)->students()->pluck('users.id')->values())
            ->whereIn('id',$users_filter)
            ->get();
        return view('indexstudents',['teacher_id'=>$id,'students'=>$students,'mystudents'=>$mystudents,'query_students'=>$query_students]);
    }

    /**
     * Asignar un alumno al profesor (usuario)
     *
     * @param id_alumno
     * @return \Illuminate\Http\Response
     */
    public function asignaralumno($id,Request $request)
    {
        $teacher = User::find($request->teacher_id);
        $teacher->students()->attach($id);

        flash('Alumno asignado correctamente');

        return redirect()->route('indexstudents',$teacher->id);
    }

    /**
     * Quitar asignacion de un alumno al profesor (usuario)
     *
     * @param id_alumno
     * @return \Illuminate\Http\Response
     */
    public function destroyasociacion($id, Request $request)
    {
        $teacher = User::find($request->teacher_id);
        $teacher->students()->detach($id);


        flash('Alumno quitado correctamente');

        return redirect()->route('indexstudents',$teacher->id);
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
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'unique:users', 'string', 'max:255', 'regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //TODO: Hacer que se pase password en array de UserTest,
            // test_authenticated_admin_can_create_a_new_user ln:22
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Auth::user()->userType == 'admin') {
            $this->validate($request, [
                'userType' => ['required', 'string', 'in:student,teacher,admin'],
            ]);
        } elseif (Auth::user()->userType == 'teacher'){
            $this->validate($request, [
                'userType'=> ['required', 'string','in:student'],
            ]);
        }

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

        $mystudents = \App\User::find($user->id)->students()->paginate(10);
        return view('perfiles/perfilteacher',['user'=>$user,'students'=>$mystudents]);
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
