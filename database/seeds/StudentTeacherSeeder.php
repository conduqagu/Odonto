<?php

use Illuminate\Database\Seeder;

class StudentTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_teacher')->insert([
            'student_id' => 3,
            'teacher_id' =>2,
        ]);
    }
}
