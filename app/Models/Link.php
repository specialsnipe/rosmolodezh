<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'links';
    protected $fillable = [
        'name',
        'url',
        'user_id',
        'exercise_id',
        'track_id',
        'block_id'
    ];

//TODO:Как относятся файлы линки и видео к юзерам
//    /**
//     * Relation with users (one to many)
//     * @return BelongsTo
//     */
//    public function user():BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }

    /**
     * Relation with exercises (one to many)
     * @return BelongsTo
     */
    public function exercise():BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Relation with blocks (one to many)
     * @return BelongsTo
     */
    public function block():BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Relation with tracks (one to many)
     * @return BelongsTo
     */
    public function track():BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}

