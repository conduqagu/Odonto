<?php

namespace App\Http\Controllers;

use App\Diente;
use App\Patient;
use App\Rules\PinProfesor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPatient($id)
    {
        $patient=Patient::find($id);
        $child=$patient->child;
        if($child==1){
            $dientes=Diente::all()->where('patient_id','=',$id)->where('number','>','50');
        }elseif($child==0){
            $dientes=Diente::all()->where('patient_id','=',$id)->where('number','<','50');
        }
        return view('dientes.index',['dientes'=>$dientes,'patient'=>$patient]);
    }
    /**
     * Create a new diente instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Diente
     */
    public function create($patient_id)
    {
        $patient = Patient::find($patient_id);
        return view('dientes.create',['patient'=>$patient]);
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
            'number' => ['required', 'integer', 'max:100'],
            'cuadrante' => ['required', 'integer','max:8' ],
            'sextante' => ['required', 'integer','max:6' ],
            'ausente' => ['required', 'boolean'],
            'patient_id'=>['required','exists:patients,id'],
        ]);
        if(Auth::user()->userType=='student'){
            $this->validate($request,[
                'pin'=>['required','string','max:255',new PinProfesor()]
            ]);

        }
        $diente=new Diente($request->all());
        $diente->save();

        flash('Diente creado correctamente');

        return redirect()->route('patients.show',[$diente->patient_id]);
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
        $diente = Diente::find($id);

        $patients = Patient::all()->pluck('name','id');

        return view('dientes.edit',['diente'=> $diente, 'patients'=>$patients ]);
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
            'number' => ['required', 'integer', 'max:100'],
            'cuadrante' => ['required', 'integer','max:8' ],
            'sextante' => ['required', 'integer','max:6' ],
            'ausente' => ['required', 'boolean'],
        ]);

        if(Auth::user()->userType=='student') {
            $this->validate($request,[
                'pin'=>['required','string','max:255',new PinProfesor()]
            ]);
        }
        $diente = Diente::find($id);
        $diente->fill($request->all());
        $diente->save();

        flash('Diente modificado correctamente');

        return redirect()->route('patients.show',[$diente->patient_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diente = Diente::find($id);
        $patient_id=$diente->patient_id;
        $diente->delete();
        flash('Diente borrado correctamente');

        return redirect()->route('patients.show',$patient_id);
    }


    public function createDientesPac($patient_id){
        $diente=new Diente();
        $diente->name='Incisivo central';
        $diente->number='11';
        $diente->cuadrante='1';
        $diente->sextante='2';
        $diente->ausente='0';
        $diente->patient_id=$patient_id;
        $diente->save();

        $diente1=new Diente();
        $diente1->name='Incisivo lateral';
        $diente1->number='12';
        $diente1->cuadrante='1';
        $diente1->sextante='2';
        $diente1->ausente='0';
        $diente1->patient_id=$patient_id;
        $diente1->save();

        $diente2=new Diente();
        $diente2->name='Canino';
        $diente2->number='13';
        $diente2->cuadrante='1';
        $diente2->sextante='2';
        $diente2->ausente='0';
        $diente2->patient_id=$patient_id;
        $diente2->save();

        $diente3=new Diente();
        $diente3->name='Primer premolar';
        $diente3->number='14';
        $diente3->cuadrante='1';
        $diente3->sextante='1';
        $diente3->ausente='0';
        $diente3->patient_id=$patient_id;
        $diente3->save();

        $diente4=new Diente();
        $diente4->name='Segundo Premolar';
        $diente4->number='15';
        $diente4->cuadrante='1';
        $diente4->sextante='1';
        $diente4->ausente='0';
        $diente4->patient_id=$patient_id;
        $diente4->save();

        $diente5=new Diente();
        $diente5->name='Primer molar';
        $diente5->number='16';
        $diente5->cuadrante='1';
        $diente5->sextante='1';
        $diente5->ausente='0';
        $diente5->patient_id=$patient_id;
        $diente5->save();

        $diente6=new Diente();
        $diente6->name='Segundo molar';
        $diente6->number='17';
        $diente6->cuadrante='1';
        $diente6->sextante='1';
        $diente6->ausente='0';
        $diente6->patient_id=$patient_id;
        $diente6->save();

        $diente7=new Diente();
        $diente7->name='Tercer molar';
        $diente7->number='18';
        $diente7->cuadrante='1';
        $diente7->sextante='1';
        $diente7->ausente='0';
        $diente7->patient_id=$patient_id;
        $diente7->save();

        $diente21=new Diente();
        $diente21->name='Incisivo central';
        $diente21->number='21';
        $diente21->cuadrante='2';
        $diente21->sextante='2';
        $diente21->ausente='0';
        $diente21->patient_id=$patient_id;
        $diente21->save();

        $diente22=new Diente();
        $diente22->name='Incisivo lateral';
        $diente22->number='22';
        $diente22->cuadrante='2';
        $diente22->sextante='2';
        $diente22->ausente='0';
        $diente22->patient_id=$patient_id;
        $diente22->save();

        $diente23=new Diente();
        $diente23->name='Canino';
        $diente23->number='23';
        $diente23->cuadrante='2';
        $diente23->sextante='2';
        $diente23->ausente='0';
        $diente23->patient_id=$patient_id;
        $diente23->save();

        $diente24=new Diente();
        $diente24->name='Primer premolar';
        $diente24->number='24';
        $diente24->cuadrante='2';
        $diente24->sextante='3';
        $diente24->ausente='0';
        $diente24->patient_id=$patient_id;
        $diente24->save();

        $diente25=new Diente();
        $diente25->name='Segundo Premolar';
        $diente25->number='25';
        $diente25->cuadrante='2';
        $diente25->sextante='3';
        $diente25->ausente='0';
        $diente25->patient_id=$patient_id;
        $diente25->save();

        $diente26=new Diente();
        $diente26->name='Primer molar';
        $diente26->number='26';
        $diente26->cuadrante='2';
        $diente26->sextante='3';
        $diente26->ausente='0';
        $diente26->patient_id=$patient_id;
        $diente26->save();

        $diente27=new Diente();
        $diente27->name='Segundo molar';
        $diente27->number='27';
        $diente27->cuadrante='2';
        $diente27->sextante='3';
        $diente27->ausente='0';
        $diente27->patient_id=$patient_id;
        $diente27->save();

        $diente28=new Diente();
        $diente28->name='Tercer molar';
        $diente28->number='28';
        $diente28->cuadrante='2';
        $diente28->sextante='3';
        $diente28->ausente='0';
        $diente28->patient_id=$patient_id;
        $diente28->save();

        $diente31=new Diente();
        $diente31->name='Incisivo central';
        $diente31->number='31';
        $diente31->cuadrante='3';
        $diente31->sextante='5';
        $diente31->ausente='0';
        $diente31->patient_id=$patient_id;
        $diente31->save();

        $diente32=new Diente();
        $diente32->name='Incisivo lateral';
        $diente32->number='32';
        $diente32->cuadrante='3';
        $diente32->sextante='5';
        $diente32->ausente='0';
        $diente32->patient_id=$patient_id;
        $diente32->save();

        $diente33=new Diente();
        $diente33->name='Canino';
        $diente33->number='33';
        $diente33->cuadrante='3';
        $diente33->sextante='5';
        $diente33->ausente='0';
        $diente33->patient_id=$patient_id;
        $diente33->save();

        $diente34=new Diente();
        $diente34->name='Primer premolar';
        $diente34->number='34';
        $diente34->cuadrante='3';
        $diente34->sextante='4';
        $diente34->ausente='0';
        $diente34->patient_id=$patient_id;
        $diente34->save();


        $diente35=new Diente();
        $diente35->name='Segundo premolar';
        $diente35->number='35';
        $diente35->cuadrante='3';
        $diente35->sextante='4';
        $diente35->ausente='0';
        $diente35->patient_id=$patient_id;
        $diente35->save();

        $diente36=new Diente();
        $diente36->name='Primer molar';
        $diente36->number='36';
        $diente36->cuadrante='3';
        $diente36->sextante='4';
        $diente36->ausente='0';
        $diente36->patient_id=$patient_id;
        $diente36->save();

        $diente37=new Diente();
        $diente37->name='Segundo molar';
        $diente37->number='37';
        $diente37->cuadrante='3';
        $diente37->sextante='4';
        $diente37->ausente='0';
        $diente37->patient_id=$patient_id;
        $diente37->save();

        $diente38=new Diente();
        $diente38->name='Tercer molar';
        $diente38->number='38';
        $diente38->cuadrante='3';
        $diente38->sextante='4';
        $diente38->ausente='0';
        $diente38->patient_id=$patient_id;
        $diente38->save();

        $diente41=new Diente();
        $diente41->name='Incisivo central';
        $diente41->number='41';
        $diente41->cuadrante='4';
        $diente41->sextante='5';
        $diente41->ausente='0';
        $diente41->patient_id=$patient_id;
        $diente41->save();

        $diente42=new Diente();
        $diente42->name='Incisivo lateral';
        $diente42->number='42';
        $diente42->cuadrante='4';
        $diente42->sextante='5';
        $diente42->ausente='0';
        $diente42->patient_id=$patient_id;
        $diente42->save();

        $diente43=new Diente();
        $diente43->name='Canino';
        $diente43->number='43';
        $diente43->cuadrante='4';
        $diente43->sextante='5';
        $diente43->ausente='0';
        $diente43->patient_id=$patient_id;
        $diente43->save();

        $diente44=new Diente();
        $diente44->name='Primer premolar';
        $diente44->number='44';
        $diente44->cuadrante='4';
        $diente44->sextante='6';
        $diente44->ausente='0';
        $diente44->patient_id=$patient_id;
        $diente44->save();


        $diente45=new Diente();
        $diente45->name='Segundo premolar';
        $diente45->number='45';
        $diente45->cuadrante='4';
        $diente45->sextante='6';
        $diente45->ausente='0';
        $diente45->patient_id=$patient_id;
        $diente45->save();

        $diente46=new Diente();
        $diente46->name='Primer molar';
        $diente46->number='46';
        $diente46->cuadrante='4';
        $diente46->sextante='6';
        $diente46->ausente='0';
        $diente46->patient_id=$patient_id;
        $diente46->save();

        $diente47=new Diente();
        $diente47->name='Segundo molar';
        $diente47->number='47';
        $diente47->cuadrante='4';
        $diente47->sextante='6';
        $diente47->ausente='0';
        $diente47->patient_id=$patient_id;
        $diente47->save();

        $diente48=new Diente();
        $diente48->name='Tercer molar';
        $diente48->number='48';
        $diente48->cuadrante='4';
        $diente48->sextante='6';
        $diente48->ausente='0';
        $diente48->patient_id=$patient_id;
        $diente48->save();

        return redirect()->route('patients.show',$patient_id);

    }

    public function createDientesPacChild($patient_id){
        $diente=new Diente();
        $diente->name='Incisivo central';
        $diente->number='51';
        $diente->cuadrante='5';
        $diente->sextante='2';
        $diente->ausente='0';
        $diente->patient_id=$patient_id;
        $diente->save();

        $diente1=new Diente();
        $diente1->name='Incisivo lateral';
        $diente1->number='52';
        $diente1->cuadrante='5';
        $diente1->sextante='2';
        $diente1->ausente='0';
        $diente1->patient_id=$patient_id;
        $diente1->save();

        $diente2=new Diente();
        $diente2->name='Canino';
        $diente2->number='53';
        $diente2->cuadrante='5';
        $diente2->sextante='2';
        $diente2->ausente='0';
        $diente2->patient_id=$patient_id;
        $diente2->save();

        $diente5=new Diente();
        $diente5->name='Primer molar';
        $diente5->number='54';
        $diente5->cuadrante='1';
        $diente5->sextante='1';
        $diente5->ausente='0';
        $diente5->patient_id=$patient_id;
        $diente5->save();

        $diente6=new Diente();
        $diente6->name='Segundo molar';
        $diente6->number='55';
        $diente6->cuadrante='5';
        $diente6->sextante='1';
        $diente6->ausente='0';
        $diente6->patient_id=$patient_id;
        $diente6->save();

        $diente21=new Diente();
        $diente21->name='Incisivo central';
        $diente21->number='61';
        $diente21->cuadrante='6';
        $diente21->sextante='2';
        $diente21->ausente='0';
        $diente21->patient_id=$patient_id;
        $diente21->save();

        $diente22=new Diente();
        $diente22->name='Incisivo lateral';
        $diente22->number='62';
        $diente22->cuadrante='6';
        $diente22->sextante='2';
        $diente22->ausente='0';
        $diente22->patient_id=$patient_id;
        $diente22->save();

        $diente23=new Diente();
        $diente23->name='Canino';
        $diente23->number='63';
        $diente23->cuadrante='6';
        $diente23->sextante='2';
        $diente23->ausente='0';
        $diente23->patient_id=$patient_id;
        $diente23->save();

        $diente26=new Diente();
        $diente26->name='Primer molar';
        $diente26->number='64';
        $diente26->cuadrante='6';
        $diente26->sextante='3';
        $diente26->ausente='0';
        $diente26->patient_id=$patient_id;
        $diente26->save();

        $diente27=new Diente();
        $diente27->name='Segundo molar';
        $diente27->number='65';
        $diente27->cuadrante='6';
        $diente27->sextante='3';
        $diente27->ausente='0';
        $diente27->patient_id=$patient_id;
        $diente27->save();

        $diente31=new Diente();
        $diente31->name='Incisivo central';
        $diente31->number='71';
        $diente31->cuadrante='7';
        $diente31->sextante='5';
        $diente31->ausente='0';
        $diente31->patient_id=$patient_id;
        $diente31->save();

        $diente32=new Diente();
        $diente32->name='Incisivo lateral';
        $diente32->number='72';
        $diente32->cuadrante='7';
        $diente32->sextante='5';
        $diente32->ausente='0';
        $diente32->patient_id=$patient_id;
        $diente32->save();

        $diente33=new Diente();
        $diente33->name='Canino';
        $diente33->number='73';
        $diente33->cuadrante='7';
        $diente33->sextante='5';
        $diente33->ausente='0';
        $diente33->patient_id=$patient_id;
        $diente33->save();

        $diente36=new Diente();
        $diente36->name='Primer molar';
        $diente36->number='74';
        $diente36->cuadrante='7';
        $diente36->sextante='4';
        $diente36->ausente='0';
        $diente36->patient_id=$patient_id;
        $diente36->save();

        $diente37=new Diente();
        $diente37->name='Segundo molar';
        $diente37->number='75';
        $diente37->cuadrante='7';
        $diente37->sextante='4';
        $diente37->ausente='0';
        $diente37->patient_id=$patient_id;
        $diente37->save();

        $diente41=new Diente();
        $diente41->name='Incisivo central';
        $diente41->number='81';
        $diente41->cuadrante='8';
        $diente41->sextante='5';
        $diente41->ausente='0';
        $diente41->patient_id=$patient_id;
        $diente41->save();

        $diente42=new Diente();
        $diente42->name='Incisivo lateral';
        $diente42->number='82';
        $diente42->cuadrante='8';
        $diente42->sextante='5';
        $diente42->ausente='0';
        $diente42->patient_id=$patient_id;
        $diente42->save();

        $diente43=new Diente();
        $diente43->name='Canino';
        $diente43->number='83';
        $diente43->cuadrante='8';
        $diente43->sextante='5';
        $diente43->ausente='0';
        $diente43->patient_id=$patient_id;
        $diente43->save();

        $diente46=new Diente();
        $diente46->name='Primer molar';
        $diente46->number='84';
        $diente46->cuadrante='8';
        $diente46->sextante='6';
        $diente46->ausente='0';
        $diente46->patient_id=$patient_id;
        $diente46->save();

        $diente47=new Diente();
        $diente47->name='Segundo molar';
        $diente47->number='85';
        $diente47->cuadrante='8';
        $diente47->sextante='6';
        $diente47->ausente='0';
        $diente47->patient_id=$patient_id;
        $diente47->save();

        return redirect()->route('patients.show',$patient_id);

    }



}
