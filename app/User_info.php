<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $table = 'userinfo';

    protected $fillable = [
        'name', 'email', 'image', 'address', 'gender', 'phone',
    ];

    public $timestamps = false;
}