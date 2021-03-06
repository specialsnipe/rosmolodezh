<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
