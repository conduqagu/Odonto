<?php

use Illuminate\Database\Seeder;

class DienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>51,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>52,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>53,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>54,
            'cuadrante' => 1,
            'sextante' => 1,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>55,
            'cuadrante' => 5,
            'sextante' => 1,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>61,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>62,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 1,
        ]);DB::table('dientes')->insert([
        'name' => 'Canino',
        'number' =>63,
        'cuadrante' => 6,
        'sextante' => 2,
        'ausente' => false,
        'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>64,
            'cuadrante' => 6,
            'sextante' => 3,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>65,
            'cuadrante' => 6,
            'sextante' => 3,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>71,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>72,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 1,
        ]);DB::table('dientes')->insert([
        'name' => 'Canino',
        'number' =>73,
        'cuadrante' => 7,
        'sextante' => 5,
        'ausente' => false,
        'patient_id' => 1,
    ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>74,
            'cuadrante' => 7,
            'sextante' => 4,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>75,
            'cuadrante' => 7,
            'sextante' => 4,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>81,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>82,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 1,
        ]);DB::table('dientes')->insert([
        'name' => 'Canino',
        'number' =>83,
        'cuadrante' => 8,
        'sextante' => 5,
        'ausente' => false,
        'patient_id' => 1,
    ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>84,
            'cuadrante' =>8,
            'sextante' => 6,
            'ausente' => false,
            'patient_id' => 1,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>85,
            'cuadrante' => 8,
            'sextante' => 6,
            'ausente' => false,
            'patient_id' => 1,
        ]);


        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>51,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>52,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>53,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>54,
            'cuadrante' => 1,
            'sextante' => 1,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>55,
            'cuadrante' => 5,
            'sextante' => 1,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>61,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>62,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>63,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>64,
            'cuadrante' => 6,
            'sextante' => 3,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>65,
            'cuadrante' => 6,
            'sextante' => 3,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>71,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>72,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>73,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>74,
            'cuadrante' => 7,
            'sextante' => 4,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>75,
            'cuadrante' => 7,
            'sextante' => 4,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>81,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>82,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>83,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>84,
            'cuadrante' =>8,
            'sextante' => 6,
            'ausente' => false,
            'patient_id' => 2,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>85,
            'cuadrante' => 8,
            'sextante' => 6,
            'ausente' => false,
            'patient_id' => 2,
        ]);

        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>51,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>52,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>53,
            'cuadrante' => 5,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>54,
            'cuadrante' => 1,
            'sextante' => 1,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>55,
            'cuadrante' => 5,
            'sextante' => 1,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>61,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>62,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>63,
            'cuadrante' => 6,
            'sextante' => 2,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>64,
            'cuadrante' => 6,
            'sextante' => 3,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>65,
            'cuadrante' => 6,
            'sextante' => 3,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>71,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>72,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>73,
            'cuadrante' => 7,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>74,
            'cuadrante' => 7,
            'sextante' => 4,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>75,
            'cuadrante' => 7,
            'sextante' => 4,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo central',
            'number' =>81,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Incisivo lateral',
            'number' =>82,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Canino',
            'number' =>83,
            'cuadrante' => 8,
            'sextante' => 5,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Primer molar',
            'number' =>84,
            'cuadrante' =>8,
            'sextante' => 6,
            'ausente' => false,
            'patient_id' => 3,
        ]);
        DB::table('dientes')->insert([
            'name' => 'Segundo molar',
            'number' =>85,
            'cuadrante' => 8,
            'sextante' => 6,
            'ausente' => false,
            'patient_id' => 3,
        ]);
    }
}
