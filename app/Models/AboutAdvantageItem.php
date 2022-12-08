<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutAdvantageItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'about_id',
    ];

    /**
     * @return BelongsTo
     */
    public function about(): BelongsTo
    {
        return $this->belongsTo(About::class);
    }
}
