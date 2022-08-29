<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackUserRequest extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id_sender',
        'track_id',
        'joining',
        'refused',
        'action',
    ];

    /**
     * Get the user that owns the TrackUserRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_sender', 'id');
    }
    /**
     * Get the user that owns the TrackUserRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
