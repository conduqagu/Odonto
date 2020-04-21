<?php

namespace App\Http\Controllers;

use App\AsociacionPatientStudent;
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
    public function index()
    {
        $patients = DB::table('asociacion_patient_students')
            ->where('student_id','=',Auth::user()->id)
            ->join('patients', 'patients.id', '=', 'asociacion_patient_students.patient_id')
            ->select('patients.*')
            ->get();
        return view('patients.index',['patients'=>$patients]);
    }
    public function indexteacher()
    {
        //$patients = DB::table('patients')
        //    ->join('patients','patients.id','=','asociacion_patient_students.patient_id')
        //    ->join('asociacion_patient_students', 'students.id', '=', 'user.id')
        //    ->join('users','users.id','=','asociacion_teacher_students.student_id')
        //    ->where('asociacion_teacher_students.teacher_id','=',Auth::user()->id())
        //    ->select('patients.*')
        //    ->get();
        $patients=Patient::all();
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
            'dni' => ['required', 'string','min:9'], //, 'unique:dni', 'unique:patients'
            'email' => ['string', 'email', 'max:255'],
            'telefono' => ['required','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required','in:I,II,III,IV,V,VI'],
            'observaciones' => ['string', 'max:255'],

        ]);
        $patient = new Patient($request->all());
        $patient->save();

        $asociacion_patient_student=new AsociacionPatientStudent();
        $asociacion_patient_student->student_id= Auth::user()->id;
        $asociacion_patient_student->patient_id=$patient->id;
        $asociacion_patient_student->save();

        flash('Paciente creado correctamente');

        return redirect()->route('patients.index');
    }


    public function storeteacher(Request $request)
    {
        $this ->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string','min:9'], //, 'unique:dni', 'unique:patients'
            'email' => ['string', 'email', 'max:255'],
            'telefono' => ['required','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required','in:I,II,III,IV,V,VI'],
            'observaciones' => ['string', 'max:255'],

        ]);
        $patient = new Patient($request->all());
        $patient->save();

        $asociacion_patient_student=new AsociacionPatientStudent();
        $asociacion_patient_student->student_id= $request->get('student_id');
        $asociacion_patient_student->patient_id=$patient->id;
        $asociacion_patient_student->save();

        flash('Paciente creado correctamente');

        return redirect()->route('indexteacher');
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

        return view('patients.edit',['patient'=>$patient ]);

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
            'dni' => ['required', 'string','min:9'],
            'email' => ['string', 'email', 'max:255'],
            'telefono' => ['required','string', 'min:8'],
            'fechaNacimiento'=> ['required','date'],
            'riesgoASA' => ['required', 'in:I,II,III,IV,V,VI'],
            'observaciones' => ['string', 'max:255']
        ]);
        $patient = Patient::find($id);
        $patient->fill($request->all());

        $patient->save();

        flash('Paciente modificado correctamente');

        return redirect()->route('patients.index');
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
}
