<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, Filterable, HasSEO;

    protected $guarded = false;

    public function getDynamicSEOData(): SEOData
    {
        // Override only the properties you want:

        return new SEOData(
            title: 'Новость | '. $this->title . '. Росмолодежь, Стирай границы',
            tags: explode(', ', $this->keywords),
            description: $this->excerpt,
            image: $this->images[0]->thumbnail_image,
        );
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
