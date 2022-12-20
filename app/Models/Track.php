<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Collection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\AverageMark\AverageMarkTrack;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Services\AcademicPerformance\AcademicPerformanceTrack;

/**
 * @property-read Collection|User[] $teachers
 * @property-read Collection|Block[] $blocks
 *
 * @property int[] $teacherIds
 *
 * @property string $nameUsersCount
 *
 * @property int $curator_id
 * @property string $icon

 */
class Track extends Model
{
    use HasFactory, SoftDeletes, HasSEO, CascadeSoftDeletes, Sluggable;

    protected array $cascadeDeletes = ['blocks','curator'];
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'slug', 'title', 'body', 'image', 'curator_id', 'icon', 'tg_url'
    ];

    protected $withCount = [
        'blocks',
        'users',
    ];

    protected $appends = [
        'image_original',
        'image_medium',
        'image_thumbnail',
        'icon_thumbnail',

    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

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


    public function getNameUsersCountAttribute()
    {

        $last = $this->users_count % 10;

        if ($last === 2 || $last === 3 || $last === 4) {
            return 'человека';
        } else {
            return 'человек';
        }
    }

    public function getExercisesCountAttribute()
    {

        $blocks = $this->blocks;
        $total = 0;
        foreach ($blocks as $block) {
            $total += $block->exercises_count;
        }
        return $total;
    }

    public function getHoursCountAttribute()
    {

        $blocks = $this->blocks;
        $total = 0;
        foreach ($blocks as $block) {
            $total += $block->duration;
        }
        return $total;
    }

    public function getNameBlocksCountAttribute()
    {

        if ($this->blocks_count === 1) {
            return 'блок';
        } elseif ($this->blocks_count === 2 || $this->blocks_count === 3 || $this->blocks_count === 4) {
            return 'блока';
        } else {
            return 'блоков';
        }
    }

    public function getImageOriginalAttribute()
    {
        return asset('storage/tracks/originals/' . $this->image);
    }

    public function getImageMediumAttribute()
    {
        return asset('storage/tracks/medium/medium_' . $this->image);
    }

    public function getImageThumbnailAttribute()
    {
        return asset('storage/tracks/thumbnail/thumbnail_' . $this->image);
    }
    public function getImageSmallAttribute()
    {
        return asset('storage/tracks/small/small_' . $this->image);
    }
    public function getImageNormalAttribute()
    {
        return asset('storage/tracks/normal/normal_' . $this->image);
    }
    public function getImageBigAttribute()
    {
        return asset('storage/tracks/big/big_' . $this->image);
    }

    public function getIconThumbnailAttribute()
    {
        return 'storage/tracks/thumbnail/thumbnail_' . $this->icon;
    }

    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }
    public function getTeacherIdsAttribute()
    {
        return $this->teachers->flatten()->pluck('id')->toArray();
    }
    public function getAverageScoreAttribute()
    {
        [ 'result'=> $result ] = AverageMarkTrack::getMark($this);
        return $result;
    }
    public function getAcademicPerformanceAttribute()
    {
        ['performance' => $performance ] = AcademicPerformanceTrack::getPerformance($this);
        return $performance * 100 . "%";
    }


    public function getDynamicSEOData(): SEOData
    {
        // Override only the properties you want:
        return new SEOData(
            title: $this->title,
            description: $this->body,
            image: $this->url_image_medium,
        );
    }
    /**
     * Relation with users (many to many)
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTrashed()->withTimestamps();
    }/**
     * Relation with users (many to many)
     *
     * @return BelongsToMany
     */
    public function usersWithoutTrashed(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    /**
     * Relation with users (many to many)
     *
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->where('role_id', 1);
    }


    public function teachers()
    {
        return $this->belongsToMany(User::class, 'track_teachers',
            'track_id', 'user_id', 'id', 'id');
    }

    public function users_requests()
    {
        return $this->hasMany(TrackUserRequest::class);
    }

    /**
     * Relation with users (many to one)
     *
     * @return BelongsTo
     */
    public function curator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'curator_id')->withTrashed();
    }

    /**
     * Relation with users (many to one)
     *
     * @return BelongsTo
     */
    public function curatorWithoutTrashed(): BelongsTo
    {
        return $this->belongsTo(User::class, 'curator_id');
    }


    /**
     * Relation with blocks (one to many)
     *
     * @return HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }

    /**
     * Relation with blocks (one to many)
     *
     * @return HasMany
     */
    public function deleted_blocks(): HasMany
    {
        return $this->hasMany(Block::class)->onlyTrashed();
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
