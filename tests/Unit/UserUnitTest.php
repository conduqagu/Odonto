<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Faker\Factory as Faker;


class UserUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $userTypes=array('admin','teacher','student');
        $letter=array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
        $faker=Faker::create();
        $data=['name' => $faker->firstName,
            'surname' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'dni' => ($faker->unique()->randomNumber($nbDigits = 8).$letter[array_rand($letter)]),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'userType' => $userTypes[array_rand($userTypes)]];
        $user = new User($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['surname'], $user->surname);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['dni'], $user->dni);
        $this->assertEquals($data['password'], $user->password);
        $this->assertEquals($data['userType'], $user->userType);
    }


}
