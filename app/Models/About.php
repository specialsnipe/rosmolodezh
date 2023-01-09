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

//    public function getCompanyImageOriginalAttribute()
//    {
//        return asset('storage/about/images/originals/' . $this->company_image);
//    }
//    public function getCompanyAdvantagesImageOriginalAttribute()
//    {
//        return asset('storage/about/images/originals/' . $this->company_advantages_image);
//    }
//    public function getCompanyGrantImageOriginalAttribute()
//    {
//        return asset('storage/about/images/originals/' . $this->company_grant_image);
//    }

    public function getImageThumbnailAttribute()
    {
        return asset('storage/about/images/thumbnail/thumbnail_' . $this->name);
    }

    public function getCompanyImageMediumAttribute()
    {
        return asset('storage/about/images/medium/medium_' . $this->company_image);
    }
    public function getCompanyAdvantagesImageMediumAttribute()
    {
        return asset('storage/about/images/medium/medium_' . $this->company_advantages_image);
    }
    public function getCompanyGrantImageMediumAttribute()
    {
        return asset('storage/about/images/medium/medium_' . $this->company_grant_image);
    }

    public function getImageSmallAttribute()
    {
        return asset('storage/about/images/small/small_' . $this->name);
    }

    public function getCompanyImageNormalAttribute()
    {
        return asset('storage/about/images/normal/normal_' . $this->company_image);
    }
    public function getCompanyAdvantagesImageNormalAttribute()
    {
        return asset('storage/about/images/normal/normal_' . $this->company_advantages_image);
    }
    public function getCompanyGrantImageNormalAttribute()
    {
        return asset('storage/about/images/normal/normal_' . $this->company_grant_image);
    }

    public function getCompanyImageBigAttribute()
    {
        return asset('storage/about/images/big/big_' . $this->company_image);
    }
    public function getCompanyAdvantagesImageBigAttribute()
    {
        return asset('storage/about/images/big/big_' . $this->company_advantages_image);
    }
    public function getCompanyGrantImageBigAttribute()
    {
        return asset('storage/about/images/big/big_' . $this->company_grant_image);
    }

    public function getGetFilenameAttribute()
    {
        return $this->name;
    }
}
