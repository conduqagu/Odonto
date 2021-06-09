<?php

namespace App\Http\Controllers;

use App\AsociacionPatientStudent;
use App\Diente;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
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
    public function index(Request $request)
    {
        $patients=User::find(Auth::user()->id)->patients()->get();
        return view('patients.index',['patients'=>$patients]);
    }
    /**
     * Lista de pacientes asignados a un profesor (usuario)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexteacher(Request $request)
    {
       // $patients=Patient::all();

        $patients = Patient::where('patients.dni','LIKE','%'.$request->get("query")."%")
            ->orWhere('patients.name','LIKE','%'.$request->get("query")."%")
            ->orWhere('patients.surname','LIKE','%'.$request->get("query")."%")
            ->get();

        return view('/patients/indexteacher',['patients'=>$patients]);
    }

    /**
     * Create a new patient instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Patient
     */
    protected function create()
    {
        return view('patients.create');
    }
    /**
     * Crear un paciente desde usuario profesor
     *
     * @return \App\Patient
     */
    protected function createteacher()
    {
        return view('patients.createteacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'unique:patients','string','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            'email' => ['nullable','string', 'email', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required','in:I,II,III'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
            'pin'=>['required','string']
        ]);
        $profesores=User::find(Auth::user()->id)->teachers()
            ->where('pin','=',MD5($request->pin))->get();

        if(count($profesores)==0){
            flash('Pin incorrecto');
            return redirect()->route('patients.create');
        }

        $patient = new Patient($request->all());
        $patient->save();

        $student=User::find(Auth::user()->id);
        $student->patients()->attach($patient->id);


        flash('Paciente creado correctamente');
        if($patient->child==0){
            return redirect()->route('createDientesPac', [$patient->id]);
        }elseif($patient->child==1){
            return redirect()->route('createDientesPacChild', [$patient->id]);
        }

    }

    /**
     * Guardar un paciente en la BD desde usuario profesor
     *
     * @param  array  $data
     * @return \App\Patient
     */
    public function storeteacher(Request $request)
    {
        $this ->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required','unique:patients', 'string','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            'email' => ['nullable','string', 'email', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required','in:I,II,III,IV,V,VI'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
        ]);

        $patient = new Patient($request->all());
        $patient->save();


        flash('Paciente creado correctamente');

        if($patient->child==0){
            return redirect()->route('createDientesPac', [$patient->id]);
        }elseif($patient->child==1){
            return redirect()->route('createDientesPacChild', [$patient->id]);
        }
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
        $patient = Patient::find($id);

        return view('patients.edit',['patient'=>$patient]);

    }
    /**
     * Editar un paciente desde un usuario profesor
     *
     * @param  array  $data
     * @return \App\Patient
     */
    public function editteacher($id)
    {
        $patient = Patient::find($id);
        $students = User::all()->where('userType', '=', 'student')->pluck('name', 'id');
        return view('patients.editteacher',['patient'=>$patient,'students'=>$students ]);

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
        $patient = Patient::find($id);

        if($request->email==$patient->email){
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            ]);
        }
        if($request->dni==$patient->dni){
            $this->validate($request,[
                'dni' => ['required','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            ]);
        }else{
            $this->validate($request,[
                'dni' => ['required','unique:patients','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            ]);
        }

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required', 'in:I,II,III,IV,V,VI'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
            'pin'=>['required','string']
        ]);

        $profesores=User::find(Auth::user()->id)->teachers()
            ->where('pin','=',MD5($request->pin))->get();

        if(count($profesores)==0){
            flash('Pin incorrecto');
            return redirect()->route('patients.edit',$id);
        }
        if($patient->child!=$request->child and $request->child==0){
            $patient->fill($request->all());
            $patient->save();
            flash('Paciente modificado correctamente');
            return redirect()->route('createDientesPac', [$patient->id]);
        }elseif($patient->child!=$request->child and $request->child==1){
            $patient->fill($request->all());
            $patient->child='0';
            $patient->save();
            flash('Un adulto no puede modificarse a infantil, el resto de los datos se han actualizado correctamente');
            return redirect()->route('patients.index');
        }else{
            $patient->fill($request->all());
            $patient->save();
            flash('Paciente modificado correctamente');
            return redirect()->route('patients.index');
        }

    }
    /**
     * Editar un paciente desde un usario profesor
     *
     * @param  array  $data
     * @return \App\Patient
     */
    public function updateteacher(Request $request, $id)
    {
        $patient = Patient::find($id);

        if($request->email==$patient->email){
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }else{
            $this->validate($request,[
                'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            ]);
        }
        if($request->dni==$patient->dni){
            $this->validate($request,[
                'dni' => ['required','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            ]);
        }else{
            $this->validate($request,[
                'dni' => ['required','unique:patients','string','max:255','regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'],
            ]);
        }

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required', 'in:I,II,III,IV,V,VI'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
        ]);
        if($patient->child!=$request->child and $request->child==0){
            $patient->fill($request->all());
            $patient->save();
            flash('Paciente modificado correctamente');
            return redirect()->route('createDientesPac', [$patient->id]);
        }elseif($patient->child!=$request->child and $request->child==1){
            $patient->fill($request->all());
            $patient->child='0';
            $patient->save();
            flash('Un adulto no puede modificarse a infantil, el resto de los datos se han actualizado correctamente');
            return redirect()->route('indexteacher');
        }else{
            $patient->fill($request->all());
            $patient->save();
            flash('Paciente modificado correctamente');
            return redirect()->route('indexteacher');
        }
    }
    /**
     * Asignar a un paciente un alumno.
     *
     * @param  array  $data
     * @return \App\Patient
     */
    public function añadirAlumno(Request $request,$id)
    {
        $students1=Patient::find($id)->students()->pluck('users.id');
        $students=User::all()->whereNotIn('id',$students1)->where('userType','=','student');
        $students->where('users.dni','LIKE','%'.$request->get("query")."%")
            ->where('users.name','LIKE','%'.$request->get("query")."%")
            ->where('users.surname','LIKE','%'.$request->get("query")."%");

        $patient=Patient::find($id);

        return view('patients.añadirAlumno',['patient'=>$patient,'students'=>$students]);
    }

    public function storeAlumno(Request $request,$student_id){
        $student=User::find($student_id);
        $student->patients()->attach($request->patient_id);

        flash('Alumno asignado correctamente');


        return redirect()->route('añadirAlumno',$request->patient_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();

        flash('Paciente borrado correctamente');

        return redirect()->route('indexteacher');
    }
    /**
     * Lista de estudiantes que se pueden eliminar de un paciente.
     *
     * @param  $id_paciente
     * @return \App\Patient
     */
    public function destroyStudent(Request $request,$id)
    {
        $students=Patient::find($id)->students()
            ->where('users.dni','LIKE','%'.$request->get("query")."%")
            ->where('users.name','LIKE','%'.$request->get("query")."%")
            ->where('users.surname','LIKE','%'.$request->get("query")."%")
            ->get();

        $patient = Patient::find($id);

        return view('patients.destroyStudent',['patient'=>$patient,'students'=>$students ]);
    }
    /**
     * Eliminar un alumno asignado a un paciente
     *
     * @return \App\Patient
     */
    public function deleteStudent(Request $request,$student_id)
    {
        $student=User::find($student_id);
        $student->patients()->detach($request->patient_id);

        flash('Alumno borrado correctamente');

        return redirect()->route('destroyStudent',$request->patient_id);
    }
}
