<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;



class UserUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $userTypes=array('admin','teacher','student');
        $data = [
            'name' => 'Concha',
            'surname' => 'Duque',
            'email' => 'concha_98@gmail.com',
            'email_verified_at' => now(),
            'dni' => '12345678R',
            'password' =>'password',
            'remember_token' => Str::random(10),
            'userType' => $userTypes[array_rand($userTypes)],
        ];

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
