<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'birthday', 'gender', 'address', 'image', 'JLPT',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['birthday'];

    public function absences()
    {
        return $this->hasMany('App\Absence');
    }

    public function overtimes()
    {
        return $this->hasMany('App\Overtime');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function rollCalls()
    {
        return $this->hasMany('App\RollCall');
    }

    public function salaries()
    {
        return $this->hasMany('App\Salary');
    }
}
