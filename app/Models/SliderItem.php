<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    use HasFactory;

    public $fillable = [
        'title', 'body', 'image', 'button_link', 'button_name', 'user_id', 'user_updater_id', 'active'
    ];

    public $appends = [
        'img_original_path',
        'img_url',
    ];

    public function getImgOriginalPathAttribute()
    {
        return 'storage/slider/images/originals/' . $this->image;
    }

    public function getImgUrlAttribute()
    {
        return asset('storage/slider/images/originals/' . $this->image);
    }

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
