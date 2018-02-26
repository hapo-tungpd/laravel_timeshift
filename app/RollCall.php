<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollCall extends Model
{
    protected $fillable = [
        'user_id', 'start_time', 'end_time', 'date', 'total_time'
    ];

    protected $dates = [
        'start_time', 'end_time', 'date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
