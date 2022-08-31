<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'description',
      'avatar'
    ];

    public function getAvatarOriginalPathAttribute()
    {
        return 'storage/team/avatars/originals/' . $this->avatar;
    }

    public function getAvatarMediumPathAttribute()
    {
        return 'storage/team/avatars/medium/medium_'. $this->avatar;
    }
    public function getAvatarThumbnailPathAttribute()
    {
        return 'storage/team/avatars/thumbnail/thumbnail_'. $this->avatar;
    }
}
