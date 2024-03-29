<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testSignIn()
    {
        $user =  factory('App\User')->create();
        $this->actingAs($user);
        $response=$this->get('/home');
        $response->assertStatus(200);

    }

    public function test_authenticated_admin_can_create_a_new_user()
    {
        $this->actingAs(factory(User::class)->create(['userType'=>'admin']));
        $user = factory('App\User')->make();
        $this->post('/user/store',$user->getAttributes());
        $this->assertEquals(2,User::all()->count());
    }

    public function test_a_user_requires_a_dni(){
        $this->actingAs(factory(User::class)->create(['userType'=>'admin']));
        $user = factory('App\User')->make(['dni' => null]);
        $this->post('/user/store',$user->toArray())
            ->assertSessionHasErrors('dni');
    }

    public function test_a_user_requires_a_name(){

        $this->actingAs(factory(User::class)->create(['userType'=>'admin']));
        $user = factory('App\User')->make(['name' => null]);
        $this->post('/user/store',$user->toArray())
            ->assertSessionHasErrors('name');
    }

    public function test_a_admin_can_read_all_the_users()
    {
        $user = factory('App\User')->create();
        $this->actingAs(factory(User::class)->create(['userType'=>'admin']));
        $response=$this->get('/user');
        $response->assertSee($user->name);
        $response->assertSee($user->surname);
        $response->assertSee($user->dni);
        $response->assertSee($user->email);
    }
    public function test_admin_can_update_the_user(){
        $this->actingAs(factory(User::class)->create(['userType'=>'admin']));
        $user = factory('App\User')->create();
        $user->name = "Updated user";
        $this->put('/user/update/'.$user->id, $user->toArray());
        $this->assertDatabaseHas('users',['id'=> $user->id , 'name' => 'Updated user']);

    }

    public function test_admin_can_delete_a_user(){

        $this->actingAs(factory(User::class)->create(['userType'=>'admin']));
        $user = factory('App\User')->create();
        $this->delete('/user/destroy/'.$user->id);
        $this->assertDatabaseMissing('users',['id'=> $user->id]);

    }
}
