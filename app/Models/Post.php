<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string @video
 * @property string @video_src
 */
class Post extends Model
{
    //...

    use HasFactory, SoftDeletes, Filterable, HasSEO, Sluggable;

    protected $guarded = false;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    protected $appends = [
        'video_src'
    ];

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

    /** @noinspection PhpUnused */
    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: 'Новость | '. $this->title . '. Росмолодежь, Стирай границы',
            description: $this->excerpt,
            image: $this->images[0]->thumbnail_image,
            tags: explode(', ', $this->keywords),
        );
    }

    public function getVideoSrcAttribute(): string
    {
        return $this->video ? asset('storage/posts/videos/' . $this->video) : '';
    }

    /**
     * Relation with images (many to many)
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(PostImage::class);
    }

    /**
     * Relation with links (many to many)
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(PostLink::class)->withTrashed();
    }

    /**
     * Relation with users (many to many)
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Relation with users (many to many)
     * @return BelongsTo
     */
    public function user_updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_updater_id')->withTrashed();
    }
}
