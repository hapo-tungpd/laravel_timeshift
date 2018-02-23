<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $table = 'userinfos';

    protected $fillable = [
        'name', 'email', 'image', 'address', 'gender', 'phone',
    ];

    public $timestamps = false;
}