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
        'original_image',
        'medium_image',
        'thumbnail_image',
        'get_filename',
    ];

    public function getOriginalImageAttribute()
    {
        return asset('storage/posts/images/originals/' . $this->name);
    }
    public function getThumbnailImageAttribute()
    {
        return asset('storage/posts/images/thumbnail/thumbnail_' . $this->name);
    }
    public function getMediumImageAttribute()
    {
        return asset('storage/posts/images/medium/medium_' . $this->name);
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
