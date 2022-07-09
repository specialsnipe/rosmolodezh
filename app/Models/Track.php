<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
    use HasFactory;

    // TODO: заполнить :fillable в этой модели
    protected $fillable = [
        'title', 'body', 'image', 'curator_id'
    ];

    /**
     * Relation with users (many to many)
     *
     * @return BelongsToMany
     */
    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
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

}
