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
            'dni' => '111111111A',
            'userType' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),

        ]);
    }
}
