<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DienteSeeder::class);
        $this->call(PatientStudentSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(StudentTeacherSeeder::class);
        $this->call(BraketSeeder::class);
        $this->call(TipoTratamientoSeeder::class);
        $this->call(TratamientoSeeder::class);
        $this->call(DiagnosticoSeeder::class);
        $this->call(DiagnosticoExamSeeder::class);

    }
}
