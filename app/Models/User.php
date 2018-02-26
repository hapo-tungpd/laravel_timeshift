<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
        'password', 'remember_token', 'deleted_at',
    ];

    protected $dates = [
        'birthday', 'deleted_at',
    ];

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function rollCalls()
    {
        return $this->hasMany(RollCall::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
