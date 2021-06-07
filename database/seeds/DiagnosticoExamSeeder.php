<?php

use Illuminate\Database\Seeder;

class DiagnosticoExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnostico_exam')->insert([
            'diagnostico_id' => 1,
            'exam_id'=>1
        ]);
    }
}
