<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertTitle('ODONTO')
                ->assertSee('¿Has olvidado tu contraseña?');
        });
    }

    public function test_login_usuario_registrado()
    {
        factory(User::class)->create(['dni'=>'12345674R']);

        $this->browse(function (Browser $browser){
            $browser->visit('/login')
                ->type('dni','12345674R')
                ->type('password','password')
                ->press('#login-btn')
                ->assertAuthenticated()
            ;
        });


    }
}
