<?php

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'name' => 'Patient',
            'surname' =>Str::random(10),
            'dni' => '12345678D',
            'email' => Str::random(10).'@gmail.com',
            'fechaNacimiento'=> \Carbon\Carbon::createFromDate(2000,01,01),
            'riesgoASA'=>'I',
            'child'=>true,
        ]);
        DB::table('patients')->insert([
            'name' => 'Patient',
            'surname' =>Str::random(10),
            'dni' => '12345678A',
            'email' => Str::random(10).'@gmail.com',
            'fechaNacimiento'=> \Carbon\Carbon::createFromDate(2000,01,01),
            'riesgoASA'=>'I',
            'child'=>true,
            'observaciones'=>'Alergia a la anestesia.',
        ]);
        DB::table('patients')->insert([
            'name' => 'Patient',
            'surname' =>Str::random(10),
            'dni' => '12345678C',
            'email' => Str::random(10).'@gmail.com',
            'fechaNacimiento'=> \Carbon\Carbon::createFromDate(2000,01,01),
            'riesgoASA'=>'I',
            'child'=>true,
        ]);


    }
}
