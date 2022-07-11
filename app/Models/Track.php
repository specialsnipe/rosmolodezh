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
        'image_original',
        'image_medium',
        'image_thumbnail',
        'url_image_original',
        'url_image_medium',
        'url_image_thumbnail'
    ];

    public function getImageOriginalAttribute()
    {
        return 'storage/tracks/originals/'. $this->image;
    }

    public function getImageMediumAttribute()
    {
        return 'storage/tracks/medium/'. $this->image;
    }

    public function getImageThumbnailAttribute()
    {
        return 'storage/tracks/thumbnail/'. $this->image;
    }

    public function getUrlImageOriginalAttribute()
    {
        return asset('storage/tracks/originals/'. $this->image);
    }

    public function getUrlImageMediumAttribute()
    {
        return asset('storage/tracks/medium/'. $this->image);
    }

    public function getUrlImageThumbnailAttribute()
    {
        return asset('storage/tracks/thumbnail/'. $this->image);
    }

    /**
     * Relation with users (many to many)
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Relation with users (many to one)
     *
     * @return BelongsTo
     */
    public function curator(): BelongsTo
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
