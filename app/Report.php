<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'date', 'today', 'tomorrow', 'problem',
    ];

    protected $dates = [
        'date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
