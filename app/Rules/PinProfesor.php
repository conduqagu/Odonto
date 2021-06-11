<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PinProfesor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $pin)
    {
        $profesores=User::find(Auth::user()->id)->teachers()
            ->where('users.pin','=',MD5($pin))->get();

        $pincorrecto=count($profesores)!=0;

        return $pincorrecto;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pin incorrecto';
    }
}
