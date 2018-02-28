<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RollCall extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'start_time', 'end_time', 'roll_call_date', 'total_time'
    ];

    protected $dates = [
        'start_time', 'end_time', 'roll_call_date', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
