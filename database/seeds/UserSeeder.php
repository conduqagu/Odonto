<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'surname' =>Str::random(10),
            'dni' => '11111111A',
            'userType' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),

        ]);
        DB::table('users')->insert([
            'name' => 'teacher',
            'surname' =>Str::random(10),
            'dni' => '22222222P',
            'userType' => 'teacher',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'pin'=>MD5('22222222P')
        ]);
        DB::table('users')->insert([
            'name' => 'student',
            'surname' =>Str::random(10),
            'dni' => '22222222A',
            'userType' => 'student',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),

        ]);
        DB::table('users')->insert([
            'name' => 'student',
            'surname' =>Str::random(10),
            'dni' => '22222222B',
            'userType' => 'student',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'student',
            'surname' =>Str::random(10),
            'dni' => '22222222C',
            'userType' => 'student',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);

    }
}
