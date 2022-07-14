<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blocks';

    protected $fillable = [
        'title',
        'body',
        'image',
        'track_id',
        'user_id',
        'date_start',
        'date_end',
    ];

    protected $withCount = [
        'exercises'
    ];
    protected $appends = [
        'image_thumbnail',
        'name_exercises_count'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'date_end',
        'date_start',
    ];

    public function getNameExercisesCountAttribute()
    {
        if ($this->exercises_count === 1 ) {
            return 'упражнение';
        } elseif ($this->exercises_count === 2 || $this->exercises_count === 3 || $this->exercises_count === 4) {
            return 'упражнения';
        } else {
            return 'упражнений';
        }
    }

    public function getImageThumbnailAttribute()
    {
        return 'storage/blocks/images/thumbnail/thumbnail_'. $this->image;
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
     *  Relation with tracks (one to many)
     * @return BelongsTo
     */
    public function track(): belongsTo
    {
        return $this->belongsTo(Track::class);
    }

    /**
     *  Relation with exercises (one to many)
     * @return HasMany
     */
    public function exercises(): hasMany
    {
        return $this->hasMany(Exercise::class);
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
