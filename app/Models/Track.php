<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'body', 'image', 'curator_id', 'icon', 'tg_url'
    ];

    protected $withCount = [
        'blocks',
        'users',
    ];

    protected $appends = [
        'name_users_count',
        'image_original',
        'image_medium',
        'image_thumbnail',
        'url_image_original',
        'url_image_medium',
        'url_image_thumbnail',
        'icon_thumbnail',
        'exercises_count',
        'hours_count',
        // 'average_score',

    ];


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
        return 'storage/tracks/originals/' . $this->image;
    }

    public function getImageMediumAttribute()
    {
        return 'storage/tracks/medium/' . $this->image;
    }

    public function getImageThumbnailAttribute()
    {
        return 'storage/tracks/thumbnail/thumbnail_' . $this->image;
    }

    public function getUrlImageOriginalAttribute()
    {
        return asset('storage/tracks/originals/' . $this->image);
    }

    public function getUrlImageMediumAttribute()
    {
        return asset('storage/tracks/medium/' . $this->image);
    }

    public function getUrlImageThumbnailAttribute()
    {
        return asset('storage/tracks/thumbnail/thumbnail_' . $this->image);
    }

    public function getIconThumbnailAttribute()
    {
        return 'storage/tracks/thumbnail/thumbnail_' . $this->icon;
    }

    /**
     * Relation with users (many to many)
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTrashed()->withTimestamps();
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
