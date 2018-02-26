<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'report_date', 'today', 'tomorrow', 'problem',
    ];

    protected $dates = [
        'report_date', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
