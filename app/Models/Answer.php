<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Collection\Collection;

/**
 * @property int $id
 * @property int $user_id
 * @property int $mark
 *
 * @property string $title
 * @property string $body
 * @property bool $sended
 *
 * @property-read User $user
 * @property-read Exercise $exercise
 * @property-read Collection|AnswerFile[] $answerFiles
 */
class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'exercise_id',
        'mark',
        'sended',
        'user_id'
    ];


    /**
     * Relation with users (one to many)
     * @return BelongsTo
     * @noinspection PhpUnused
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id', 'id')->withTrashed();
    }

    /**
     * Relation with exercises (one to many)
     * @return BelongsTo
     * @noinspection PhpUnused
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
    /**
     *  Relation with answer_files (one to many)
     * @return HasMany
     * @noinspection PhpUnused
     */
    public function answerFiles(): HasMany
    {
        return $this->hasMany(AnswerFile::class);
    }

}
