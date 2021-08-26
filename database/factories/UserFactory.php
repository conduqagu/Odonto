<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $userTypes=array('admin','teacher','student');
    $letter=array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'dni' => ($faker->unique()->randomNumber($nbDigits = 8).$letter[array_rand($letter)]),
        'password' => '$2y$10$9wCqvYj1qTdvYvOnFfghTuT9SxmpNGvX1p6g7aDpzZ2A8AyVak7Cy',//password
        'remember_token' => Str::random(10),
        'userType' => $userTypes[array_rand($userTypes)],
    ];
});

