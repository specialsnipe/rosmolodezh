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

    public function getAvatarSmallPathAttribute()
    {
        return 'storage/team/avatars/small/small_'. $this->avatar;
    }

    public function getImageNormalAttribute()
    {
        return 'storage/team/avatars/normal/normal_' . $this->image;
    }

    public function getAvatarBigPathAttribute()
    {
        return 'storage/team/avatars/big/big_'. $this->avatar;
    }
}
