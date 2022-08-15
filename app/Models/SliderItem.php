<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $fillable = [
        'title', 'body', 'image', 'link', 'button', 'user_id', 'user_updater_id'
    ];

    /**
     * Get the user that owns the SliderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the user that owns the SliderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_updater_id');
    }
}
