<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Overtime extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'overtime_date', 'start_time', 'end_time', 'total_time',
    ];

    protected $dates = [
        'overtime_date', 'start_time', 'end_time', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
