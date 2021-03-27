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
        $patients = DB::table('asociacion_patient_students')
            ->where('student_id','=',Auth::user()->id)
            ->join('patients', 'patients.id', '=', 'asociacion_patient_students.patient_id')
            ->where('patients.name','LIKE','%'.$request->get("query")."%")
            ->select('patients.*')
            ->get();
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
    //TODO: revisar funcionalidad:
    /**
     * Crear un paciente desde usuario profesor
     *
     * @return \App\Patient
     */
    protected function createteacher()
    {
        $students = User::all()->where('userType', '=', 'student')->pluck('name', 'id');
        return view('patients.createteacher',['students'=>$students]);
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
            'dni' => ['required', 'unique:patients','string','min:9'],
            'email' => ['nullable','string', 'email', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required','in:I,II,III'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
            'pin'=>['required','integer']
        ]);

        $profesor=DB::select(DB::raw('SELECT * FROM laravel.users
        LEFT JOIN laravel.asociacion_teacher_students ON (laravel.asociacion_teacher_students.student_id = users.id)
        LEFT JOIN laravel.users as teachers ON (teachers.id = laravel.asociacion_teacher_students.teacher_id)
        WHERE laravel.users.id ='.Auth::user()->id.' AND teachers.pin='.$request->get('pin').';'));

        if(count($profesor)==0){
            flash('Pin incorrecto');
            return redirect()->route('patients.create');
        }

        $patient = new Patient($request->all());
        $patient->save();

        $asociacion_patient_student=new AsociacionPatientStudent();
        $asociacion_patient_student->student_id=Auth::user()->id;
        $asociacion_patient_student->patient_id=$patient->id;
        $asociacion_patient_student->save();


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
            'dni' => ['required','unique:patients', 'string','min:9'],
            'email' => ['nullable','string', 'email', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required','in:I,II,III,IV,V,VI'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
        ]);

        $patient = new Patient($request->all());
        $patient->save();

        if ($request->get('student_id')!=null){
            $asociacion_patient_student=new AsociacionPatientStudent();
            $asociacion_patient_student->student_id= $request->get('student_id');
            $asociacion_patient_student->patient_id=$patient->id;
            $asociacion_patient_student->save();
        }

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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required','string','min:9'],
            'email' => ['nullable','string', 'email', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required', 'in:I,II,III,IV,V,VI'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean'],
            'pin'=>['required','integer']
        ]);

        $profesor=DB::select(DB::raw('SELECT * FROM laravel.users
        LEFT JOIN laravel.asociacion_teacher_students ON (laravel.asociacion_teacher_students.student_id = users.id)
        LEFT JOIN laravel.users as teachers ON (teachers.id = laravel.asociacion_teacher_students.teacher_id)
        WHERE laravel.users.id ='.Auth::user()->id.' AND teachers.pin='.$request->get('pin').';'));

        if(count($profesor)==0){
            flash('Pin incorrecto');
            return redirect()->route('patients.edit',$id);
        }
        $patient = Patient::find($id);
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required','string','min:9'],
            'email' => ['nullable','string', 'email', 'max:255'],
            'telefono' => ['nullable','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required', 'in:I,II,III,IV,V,VI'],
            'observaciones' => ['nullable','string', 'max:255'],
            'child'=>['required','boolean']

        ]);
        $patient = Patient::find($id);
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
    public function añadirAlumno($id)
    {
        $students=DB::table('users')
            ->whereNotIn('users.id', AsociacionPatientStudent::where('asociacion_patient_students.patient_id','=',$id)
                ->join('users', function($join) {
                    $join->on('users.id','=','asociacion_patient_students.student_id');
                })->pluck('users.id')->values())->where('userType','=','student')->pluck('name', 'id');

        return view('patients.añadirAlumno',['patient_id'=>$id,'students'=>$students]);
    }

    public function storeAlumno(Request $request,$id){
        $asociacion_patient_student=new AsociacionPatientStudent();
        $asociacion_patient_student->student_id= $request->get('student_id');
        $asociacion_patient_student->patient_id=$id;
        $asociacion_patient_student->save();

        return redirect()->route('indexteacher');
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
    public function destroyStudent($id)
    {
        $users = DB::table('asociacion_patient_students')
            ->where('patient_id','=',$id)
            ->join('users','users.id','=','asociacion_patient_students.student_id')
            ->select('users.*')
            ->get();
        $students= $users->where('userType','=','student')->pluck('name', 'id');
        $patient = Patient::find($id);

        return view('patients.destroyStudent',['patient'=>$patient,'students'=>$students ]);
    }
    /**
     * Eliminar un alumno asignado a un paciente
     *
     * @return \App\Patient
     */
    public function deleteStudent(Request $request,$id)
    {
        $students = DB::table('asociacion_patient_students')
            ->where('student_id','=',$request->get('student_id'))
            ->where('patient_id','=',$id)
            ->select('asociacion_patient_students.*')
            ->get();
        $asociacion_patient_student=AsociacionPatientStudent::find($students[0]->id);

        $asociacion_patient_student->delete();

        flash('Alumno borrado correctamente');

        return redirect()->route('indexteacher');
    }
}
