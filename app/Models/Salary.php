<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Salary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'pay_per_hour', 'insurance_money', 'final_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
