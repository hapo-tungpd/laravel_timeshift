<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'day', 'today', 'tomorrow', 'problem',
    ];

    protected $dates = [
        'day', 'deleted_at',
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
