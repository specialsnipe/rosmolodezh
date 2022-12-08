<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutCompetitionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
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
