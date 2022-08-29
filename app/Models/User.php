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

class User extends Authenticatable implements MustVerifyEmail
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
        'phone',
        'vk_url',
        'curator_job',
        'curator_about'
    ];

    // protected $appends = [
    //     'avatar_original_path',
    //     'avatar_thumbnail_path',
    //     'avatar_medium_path',
    //     'first_and_last_names',
    //     'short_name',
    //     'all_names',
    //     'tg_url',
    //     'average_mark'
    // ];

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
    public function getShortNameAttribute()
    {
        return $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . '. ' . mb_substr($this->father_name, 0, 1) . '.';
    }
    public function getTgUrlAttribute()
    {
        return 'https://t.me/'.$this->tg_name;
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



    public function tracks_requests()
    {
        return $this->hasMany(TrackUserRequest::class, 'user_id_sender', 'id');
    }

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
    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Role::class);
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

    public function getAnswer($exercise)
    {
        return $this->hasMany(Answer::class)->where('exercise_id', $exercise->id)->first();
    }

    public function getAverageMarkAttribute($exercise)
    {
        $answers = $this->hasMany(Answer::class)->get();
        $result = 0;
        $i = 0;
            foreach ($answers as $answer) {
                if($answer->mark) {
                    $result += $answer->mark;
                    $i++;
                }
            }

        if($i === 0) {
            return 0;
        }
        return round($result / $i, 1);
    }

    /**
     * @return BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(User::class);
    }


    public function tracksWhereTeacher()
    {
        return $this->belongsToMany(Track::class, 'track_teachers',
            'user_id', 'track_id', 'id', 'id');
    }

}
