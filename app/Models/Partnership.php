<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partnership extends Model
{
    use HasFactory;
    public $fillable = [
        'title', 'body', 'image'
    ];

    /**
     * Relation hasMany to items of partnership
     *
     * @return HasMany
     */
    public function partnershipItems(): HasMany
    {
        return $this->hasMany(PartnershipItem::class);
    }
}
