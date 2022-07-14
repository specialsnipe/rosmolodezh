<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'user_id',
        'block_id',
        'complexity_id',
        'active',
        'time',
    ];

    protected $appends = [
        'name_minute_count'
    ];


    public function getNameMinuteCountAttribute()
    {

        $finished = $this->time % 10;
        $last = 'минут';

        if ($finished === 1 ) {
            $last = 'минута';
        }
        if ($finished === 2 || $finished === 3 || $finished === 4) {
            $last = 'минуты';
        }
        if($this->time == 11 ||$this->time == 12 ||$this->time == 13 ||$this->time == 14 ) {
            $last = 'минут';
        }

        return $last;
    }
    /**
     *  Relation with users (one to many)
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    /**
     *  Relation with users (one to many)
     * @return HasMany
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the complexity that owns the Exercise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complexity(): BelongsTo
    {
        return $this->belongsTo(Complexity::class);
    }

    /**
     *  Relation with blocks (one to many)
     * @return BelongsTo
     */
    public function block(): belongsTo
    {
        return $this->belongsTo(Track::class);
    }
    /**
     *  Relation with answers (one to many)
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     *  Relation with videos (one to many)
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Relation with links (one to many)
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Relation with files (one to many)
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

}
