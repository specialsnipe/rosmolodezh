<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\AverageMark\AverageMarkBlock;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\AcademicPerformance\AcademicPerformanceBlock;

class Block extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, Sluggable;

    protected $table = 'blocks';
    protected $cascadeDeletes = ['exercises'];

    protected $fillable = [
        'slug',
        'title',
        'body',
        'image',
        'track_id',
        'user_id',
        'date_start',
        'priority',
    ];

    protected $withCount = [
        'exercises'
    ];
    protected $with = [
        'exercises'
    ];
    protected $appends = [
        'image_original',
        'image_medium',
        'image_thumbnail',
        'image_small',
        'image_big'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'date_end',
        'date_start',
        'deleted_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getNextBlockUrlAttribute()
    {
        $block = Block::where('track_id', $this->track_id)
                    ->where('priority', $this->priority + 1)
                    ->first();
        $track = Track::find($this->track_id);
        if ($block) {
            return route('profile.tracks.blocks.show',[$track->slug,$block->slug]);
        }
        return false;
    }


    public function getBeforeBlockUrlAttribute()
    {
        $block = Block::where('track_id', $this->track_id)
                    ->where('priority', $this->priority - 1)
                    ->first();
        $track = Track::find($this->track_id);
        if ($block) {
            return route('profile.tracks.blocks.show',[$track->slug,$block->slug]);
        }
        return false;
    }

    public function getDurationAttribute()
    {
        $exercises = Exercise::where('block_id', $this->id)->without(['creator', 'users', 'complexity', 'block', 'answers'])->get();
//        $exercises = $this->exercises;
        $time = 0;

        foreach ($exercises as $exercise) {
            $time += $exercise->time;
        }
        return round($time / 60);
    }

    public function getNameDurationAttribute()
    {
        $duration = $this->duration % 10;

        if ($duration === 2 || $duration === 3 || $duration === 4) {
            return 'часа';
        } elseif ($duration === 1 && $this->duration !== 11) {
            return 'час';
        } else {
            return 'часов';
        }
    }


    public function getAverageScoreAttribute(): int
    {
        ['result'=> $result ] = AverageMarkBlock::getMark($this);
        return $result;
    }
    public function getAcademicPerformanceAttribute()
    {
        [ "performance" => $tmpPerformance ] = AcademicPerformanceBlock::getPerformance($this);
        return $tmpPerformance * 100 . " %";
    }

    public function getNameExercisesCountAttribute()
    {
        if ($this->exercises_count === 1) {
            return 'упражнение';
        } elseif ($this->exercises_count === 2 || $this->exercises_count === 3 || $this->exercises_count === 4) {
            return 'упражнения';
        } else {
            return 'упражнений';
        }
    }

    public function getImageOriginalAttribute()
    {
        return asset('storage/blocks/images/originals/' . $this->image);
    }

    public function getImageNormalAttribute()
    {
        return asset('storage/blocks/images/normal/normal_' . $this->image);
    }

    public function getImageThumbnailAttribute()
    {
        return asset('storage/blocks/images/thumbnail/thumbnail_' . $this->image);
    }

    public function getImageMediumAttribute()
    {
        return asset('storage/blocks/images/medium/medium_' . $this->image);
    }

    public function getImageSmallAttribute()
    {
        return asset('storage/blocks/images/small/small_' . $this->image);
    }

    public function getImageBigAttribute()
    {
        return asset('storage/blocks/images/big/big_' . $this->image);
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
     *  Relation with users (one to many)
     *
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
        return $this->hasMany(Exercise::class);
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

    public function started_blocks()
    {
        return $this->belongsToMany(User::class);
    }

}
