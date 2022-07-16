<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'first_name',
        'last_name',
        'father_name',
        'avatar',
        'age',
        'about',
        'gender_id',
        'occupation_id',
        'role_id',
        'email',
        'password',
        'tg_name',
        'tg_id',
        'tg_url',
        'vk_url',
    ];

    protected $appends = [
        'avatar_original_path',
        'avatar_thumbnail_path',
        'avatar_medium_path',
        'first_and_last_names',
        'all_names'
    ];

    public function getAvatarOriginalPathAttribute()
    {
        return 'storage/users/avatars/originals/' . $this->avatar;
    }
    public function getCheckStudentIsAttribute()
    {
        return  $this->role_id == 1;
    }
    public function getAvatarMediumPathAttribute()
    {
        return 'storage/users/avatars/medium/medium_'. $this->avatar;
    }
    public function getAvatarThumbnailPathAttribute()
    {
        return 'storage/users/avatars/thumbnail/thumbnail_'. $this->avatar;
    }
    public function getFirstAndLastNamesAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
    public function getAllNamesAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->father_name;
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


    /**
     * Relation with gender (one to many)
     *
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Relation with occupations (one to many)
     *
     * @return BelongsTo
     */
    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    /**
     * Relation with role table (one to many)
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relation with tracks (many to many)
     *
     * @return BelongsToMany
     */
    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class)->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(User::class);
    }

}
