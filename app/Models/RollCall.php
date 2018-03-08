<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RollCall extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'start_time', 'end_time', 'day', 'total_time',
    ];

    protected $dates = [
        'start_time', 'end_time', 'day', 'deleted_at',
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
