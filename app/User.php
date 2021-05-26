<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname', 'email' ,'dni','userType','password', 'pin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function teachers () {
        return $this->belongsToMany('App\User','student_teacher', 'student_id', 'teacher_id');
    }
    public function students () {
        return $this->belongsToMany('App\User','student_teacher', 'teacher_id', 'student_id');
    }
    public function patients () {
        return $this->belongsToMany('App\Patient','patient_student','student_id','patient_id');
    }
}
