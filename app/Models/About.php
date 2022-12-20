<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'company_desc',
        'company_image',

        'company_advantages_title',
        'company_advantages_image',
        'company_grant_image',
    ];

    /**
     * @return HasMany
     */
    public function advantageItems(): HasMany
    {
        return $this->hasMany(AboutAdvantageItem::class);
    }

    /**
     * @return HasMany
     */
    public function competitionItems(): HasMany
    {
        return $this->hasMany(AboutCompetitionItem::class);
    }

    /**
     * @return HasMany
     */
    public function grantItems(): HasMany
    {
        return $this->hasMany(AboutGrantItem::class);
    }

    /**
     * @return HasMany
     */
    public function infoItems(): HasMany
    {
        return $this->hasMany(AboutInfoItem::class);
    }
}
