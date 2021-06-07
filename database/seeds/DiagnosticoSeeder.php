<?php

use Illuminate\Database\Seeder;

class DiagnosticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnosticos')->insert([
            'nombre' => Str::random(10),
        ]);
        DB::table('diagnosticos')->insert([
            'nombre' => Str::random(10),
        ]);
    }
}
