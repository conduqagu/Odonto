<?php

use Illuminate\Database\Seeder;

class TipoTratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_tratamientos')->insert([
            'name'=>'REVISION DE PACIENTES EN TRATAMIENTO',
            'coste'=>30.0,
            'iva'=>0.0
        ]);
        DB::table('tipo_tratamientos')->insert([
            'name'=>'REVISIÓN SIMPLE',
            'coste'=>15.0,
            'iva'=>0.0
        ]);
        DB::table('tipo_tratamientos')->insert([
            'name'=>'SIALOMETRIA',
            'coste'=>20.0,
            'iva'=>0.0
        ]);
        DB::table('tipo_tratamientos')->insert([
            'name'=>'BIOPSIA ÓSEA',
            'coste'=>120.0,
            'iva'=>0.0
        ]);
        DB::table('tipo_tratamientos')->insert([
            'name'=>'FLUOR 1ª A 4ªSESION',
            'coste'=>7.0,
            'iva'=>0.0
        ]);
        DB::table('tipo_tratamientos')->insert([
            'name'=>'TARTRECTOMIA Y ENSEÑANZA HIGIENE ORAL',
            'coste'=>15.0,
            'iva'=>0.0
        ]);
    }
}
