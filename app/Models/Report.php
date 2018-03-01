<?php

namespace App;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
