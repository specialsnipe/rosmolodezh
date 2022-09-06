<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    protected $appends = [
        // 'original_image',
        // 'medium_image',
        // 'thumbnail_image',
        'image_original',
        'image_big',
        'image_normal',
        'image_medium',
        'image_small',
        'image_thumbnail',
        'get_filename',
    ];

    public function getImageOriginalAttribute()
    {
        return asset('storage/posts/images/originals/' . $this->name);
    }

    public function getImageThumbnailAttribute()
    {
        return asset('storage/posts/images/thumbnail/thumbnail_' . $this->name);
    }

    public function getImageMediumAttribute()
    {
        return asset('storage/posts/images/medium/medium_' . $this->name);
    }

    public function getImageSmallAttribute()
    {
        return asset('storage/posts/images/small/small_' . $this->name);
    }

    public function getImageNormalAttribute()
    {
        return asset('storage/posts/images/normal/normal_' . $this->name);
    }

    public function getImageBigAttribute()
    {
        return asset('storage/posts/images/big/big_' . $this->name);
    }

    public function getGetFilenameAttribute()
    {
        return $this->name;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
