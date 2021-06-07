<?php

use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tratamientos')->insert([
            'coste'=>30.0,
            'iva'=>0.0,
            'terapia'=>'sin definir',
            'tipo_tratamiento_id'=>1,
            'exam_id'=>1,
            'fecha_inicio' =>  \Carbon\Carbon::createFromDate(2021,06,07),

        ]);
    }
}
