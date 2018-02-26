<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $fillable = [
        'user_id', 'date', 'start_time', 'end_time', 'total_time',
    ];

    protected $dates = [
        'date', 'start_time', 'end_time',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
