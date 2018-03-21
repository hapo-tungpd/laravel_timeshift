<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const MALE = 1;
    const FEMALE = 0;
    const JLPT = [
        'None', 'N1', 'N2', 'N3', 'N4','N5'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'birthday',
        'gender', 'address', 'image', 'JLPT',
    ];

    protected $attributes = [
        'JLPT' => 'None',
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

    /**
     * Connect with absences table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    /**
     * Connect with overtimes table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    /**
     * Connect with reports table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Connect with roll calls table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rollCalls()
    {
        return $this->hasMany(RollCall::class);
    }

    /**
     * Connect with salaries table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function authorizations() {
        return $this->hasMany(Authorization::class);
    }
}
