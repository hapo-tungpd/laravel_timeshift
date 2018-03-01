<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Overtime extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'day', 'start_time', 'end_time', 'total_time',
    ];

    protected $dates = [
        'day', 'start_time', 'end_time', 'deleted_at',
    ];

    /**
     * Connect to users table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
