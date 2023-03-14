<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\UserScopes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Collection\Collection;

/**
 * @property-read Block $block
 * @property-read Collection|Block[] $started_blocks
 *
 *
 * @property string $last_name
 * @property string $first_name
 * @property string $father_name
 * @property string $tg_name
 * @property string $avatar
 * @property int $role_id
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        SoftDeletes,
        Filterable,
        Sluggable,
        UserScopes;


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

    protected $appends = [
        'avatar_original_path',
        // 'avatar_thumbnail_path',
        // 'avatar_medium_path',
        'first_and_last_names',
        // 'short_name',
        // 'all_names',
        // 'tg_url',
        // 'average_mark'
    ];
    protected $with = [
        'role',
        'occupation',
        'tracks'
    ];


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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'login'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return string
     */
    public function getAvatarOriginalPathAttribute(): string
    {
        return 'storage/users/avatars/originals/' . $this->avatar;
    }

    /**
     * @return string
     */
    public function getAvatarMediumPathAttribute(): string
    {
        return 'storage/users/avatars/medium/medium_'. $this->avatar;
    }

    /**
     * @return string
     */
    public function getAvatarThumbnailPathAttribute(): string
    {
        return 'storage/users/avatars/thumbnail/thumbnail_'. $this->avatar;
    }

    /**
     * @return string
     */
    public function getAvatarBigPathAttribute(): string
    {
        return 'storage/users/avatars/big/big_'. $this->avatar;
    }

    /**
     * @return string
     */
    public function getCheckStudentIsAttribute(): string
    {
        return  $this->role_id == 1;
    }

    /**
     * @return string
     */
    public function getFirstAndLastNamesAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * @return string
     */
    public function getAllNamesAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->father_name;
    }

    /**
     * @return string
     */
    public function getShortNameAttribute(): string
    {
        return $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . '. ' . mb_substr($this->father_name, 0, 1) . '.';
    }

    /**
     * @return string
     */
    public function getTgUrlAttribute(): string
    {
        return 'https://t.me/'.$this->tg_name;
    }


    /**
     * @return HasMany
     */
    public function tracks_requests(): HasMany
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

    /**
     * @return HasManyThrough
     */
    public function permissions(): HasManyThrough
    {
        return $this->hasManyThrough(Permission::class, Role::class);
    }

    /**
     *
     * @param Exercise
     * @return Answer|null
     */
    public function getAnswer(Exercise $exercise): Answer |null
    {
        /** @var Answer $relation */
        $relation = $this->hasMany(Answer::class)->where('exercise_id', $exercise->id)->first();

        if (!$relation) return null;

        $relation->class_name = match ($relation->mark) {
            '2' || '1' => 'danger',
            '3' => 'warning',
            '4' || '5' => 'success',
            default => 'dark',
        };

        return $relation;
    }

    /**
     * @return float|int
     */
    public function getAverageMarkAttribute(): float|int
    {
        $answers = $this->hasMany(Answer::class)->whereNotNull('mark')->get();
        $result = 0;

        if($answers->count() === 0) {
            return $result;
        }

        foreach ($answers as $answer) {
            $result += $answer->mark;
        }

        return round($result / $answers->count(), 1);
    }

    /**
     * @param int $trackId
     * @return int
     */
    public function getSolvedTrackExercisesAttribute(int $trackId): int
    {
        $track = Track::find($trackId);
        $exercises = [];

        $solvedExercises = 0;

        foreach($track->blocks as $block) {
            $exercises[$block->id] = $block->exercises;
        }

        $exercises = collect($exercises)->flatten();

        foreach($exercises as $exercise) {
            if ($exercise->answers->where('user_id', $this->id)->first()) {
                $solvedExercises++;
            }
        }

        return $solvedExercises;
    }

    /**
     * @param int $trackId
     * @return int
     */
    public function getAnswerMarkCountAttribute(int $trackId): int
    {
        $track = Track::find($trackId);

        $exercises = [];
        $solvedExercises = 0;

        foreach($track->blocks as $block) {
            $exercises[$block->id] = $block->exercises;
        }

        $exercises = collect($exercises)->flatten();

        foreach($exercises as $exercise) {
            if ($exercise->answers->where('user_id', $this->id)->whereNotNull('mark')->first()) {

                $solvedExercises++;
            }
        }

        return $solvedExercises;
    }

    /**
     * @param $track
     * @return float|int
     */
    public function getAverageMarkTrackAttribute($track): float|int
    {
        $track = Track::find($track);
        $exercises = [];

        $solvedExercises = 0;
        $averageMark = 0;

        foreach($track->blocks as $block) {
            $exercises[$block->id] = $block->exercises;
        }

        $exercises = collect($exercises)->flatten();

        foreach($exercises as $exercise) {
            $answer = $exercise->answers->where('user_id', $this->id)->whereNotNull('mark')->first();
            if ($answer) {
                $solvedExercises++;
                $averageMark += $answer->mark;
            }
        }

        if($solvedExercises == 0) {
            return 0;
        }
        return round($averageMark / $solvedExercises, 1);
    }


    /**
     * @return BelongsTo
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function started_blocks(): BelongsToMany
    {
        return $this->belongsToMany(Block::class);
    }
/**
     * Relation with tracks (many to many)
     *
     * @return BelongsToMany
     */
    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'track_user',
        'user_id', 'track_id', 'id', 'id')->withTimestamps();
    }
/**
     * Relation with tracks (many to many)
     *
     * @return BelongsToMany
     */
    public function tracksWithAnswers(): BelongsToMany
    {
        return $this
            ->belongsToMany(Track::class, 'track_user',
        'user_id', 'track_id', 'id', 'id')
            ->with([
                'blocks',
                'blocks.exercises',
                'blocks.exercises.answers',
                'blocks.exercises.answers.answerFiles',
            ])
            ->withTimestamps();
    }

    public function tracksWhereTeacher()
    {
        return $this->belongsToMany(Track::class, 'track_teachers',
            'user_id', 'track_id', 'id', 'id')->withTimestamps();
    }

}
