<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'day', 'start_time', 'end_time', 'type', 'content',
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
