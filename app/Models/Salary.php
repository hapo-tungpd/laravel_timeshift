<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'basic_salary', 'OT_salary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
