<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_student')->insert([
            'student_id' => 3,
            'patient_id' =>1,

        ]);

        DB::table('patient_student')->insert([
            'student_id' => 4,
            'patient_id' =>1,
        ]);
    }
}
