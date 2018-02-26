<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = "salaries";

    protected $fillable = [
        'user_id', 'basic_salary', 'OT_salary',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
