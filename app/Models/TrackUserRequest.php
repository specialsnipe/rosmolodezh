<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
