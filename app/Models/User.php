<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'gender_id',
        'role_id',
        'avatar',
        'about',
        'age',
        'email',
        'login',
        'password',
        'occupation_id',
        'tg_url',
        'vk_url',
    ];

    protected $appends = [
        'avatar_original_path',
        'avatar_thumbnail_path'
    ];

    public function getAvatarOriginalPathAttribute()
    {
        return 'storage/users/avatars/originals/'. $this->avatar;
    }
    public function getAvatarThumbnailPathAttribute()
    {
        return 'storage/users/avatars/thumbnail/'. $this->avatar;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
