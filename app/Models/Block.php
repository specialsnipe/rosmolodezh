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
        'image_original',
        'image_medium',
        'image_thumbnail',
        'name_exercises_count',
        // 'duration',
        // 'name_duration'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'date_end',
        'date_start',
    ];


    // public function getDurationAttribute()
    // {
    //     $exercises = $this->exercises;
    //     $time = 0;
    //     foreach ($exercises as $exercise){
    //         $time += $exercise->time;
    //     }

    //     // dd(round($time / 60));
    //     return round($time / 60);
    // }

    // public function getNameDurationAttribute()
    // {
    //     $duration = $this->duration % 10;

    //     if ($duration === 2 || $duration === 3 || $duration === 4) {
    //         return 'часа';
    //     } elseif($duration === 1 && $this->duration !== 11) {
    //         return 'час';
    //     } else {
    //         return 'часов';
    //     }
    // }

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

    public function getImageOriginalAttribute()
    {
        return 'storage/blocks/images/originals/'. $this->image;
    }
    public function getImageThumbnailAttribute()
    {
        return 'storage/blocks/images/thumbnail/thumbnail_'. $this->image;
    }
    public function getImageMediumAttribute()
    {
        return 'storage/blocks/images/medium/medium_'. $this->image;
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
        return $this->belongsTo(Track::class)->withTrashed();
    }

    /**
     *  Relation with exercises (one to many)
     * @return HasMany
     */
    public function exercises(): hasMany
    {
        return $this->hasMany(Exercise::class)->withTrashed();
    }

    /**
     *  Relation with exercises (one to many)
     * @return HasMany
     */
    public function deleted_exercises(): hasMany
    {
        return $this->hasMany(Exercise::class)->onlyTrashed();
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
