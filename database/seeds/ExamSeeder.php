<?php

use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            'date' =>  \Carbon\Carbon::createFromDate(2021,06,07),
            'cobrado' =>False,
            'patient_id'=>1,
            'tipoExam'=>'inicial',
            'otros'=>Str::random(20),

            'aspectoExtraoralNormal'=>true,
            'cancerOral'=>true,
            'anomaliasLabios'=>true,
            'patologiaMucosa'=>'Ninguna',
            'fluorosis'=>'Discutible',
            'estadoS1'=>'sano',
            'estadoS2'=>'hemorragia',
            'estadoS3'=>'tártaro',
            'estadoS4'=>'sano',
            'estadoS5'=>'hemorragia',
            'estadoS6'=>'sano',
            'claseAngle'=>'clase I',
            'lateralAngle'=>'Unilateral',
            'tipoDentición'=>'Temporal',
            'apiñamientoIncisivoInferior'=>true,
            'apiñamientoIncisivoSuperior'=>true,
            'perdidaEspacioAnterior'=>true,
            'perdidaEspacioPosterior'=>true,
            'mordidaCruzadaAnterior'=>true,
            'mordidaCruzadaPosterior'=>true,
            'desviacionLineaMedia'=>true,
            'mordidaAbierta'=>true,
            'habitos'=>true,

        ]);


        DB::table('exams')->insert([
            'date' =>  \Carbon\Carbon::createFromDate(2021,06,07),
            'cobrado' =>False,
            'patient_id'=>1,
            'tipoExam'=>'infantil',
            'otros'=>Str::random(20),

            'aspectoGeneral'=>Str::random(20),
            'talla'=>Str::random(20),
            'peso'=>Str::random(20),
            'piel'=>Str::random(20),
            'anomaliaForma'=>Str::random(20),
            'anomaliaTamaño'=>Str::random(20)
        ]);

        DB::table('exams')->insert([
            'date' =>  \Carbon\Carbon::createFromDate(2021,06,07),
            'cobrado' =>False,
            'patient_id'=>1,
            'tipoExam'=>'periodoncial',
            'otros'=>Str::random(20),

            'indicePlaca'=>10.5,
            'color'=>'rosa',
            'borde'=>'afilado',
            'aspecto'=>'puntillado',
            'consistencia'=>'firme',
            'biotipo'=>3,

        ]);

        DB::table('exams')->insert([
            'date' =>  \Carbon\Carbon::createFromDate(2021,06,07),
            'cobrado' =>False,
            'patient_id'=>1,
            'tipoExam'=>'ortodoncial',
            'otros'=>Str::random(20),
            'patronFacial'=>'dolicofacial',
            'perfil'=>'armonico',
            'menton'=>'marcado'

        ]);

        DB::table('exams')->insert([
            'date' =>  \Carbon\Carbon::createFromDate(2021,06,07),
            'cobrado' =>False,
            'patient_id'=>1,
            'tipoExam'=>'evOrto',
            'otros'=>Str::random(20),
            'previsto'=>Str::random(20),
            'maxilar'=>Str::random(20),
            'mandibular'=>Str::random(20),
            'logrado'=>Str::random(20),
            'orto_id'=>4

        ]);

        DB::table('exams')->insert([
            'date' =>  \Carbon\Carbon::createFromDate(2021,06,07),
            'cobrado' =>False,
            'patient_id'=>1,
            'tipoExam'=>'otro',
            'otros'=>Str::random(20),
        ]);

    }
}
