<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'body',
        'exercise_id',
        'mark',
        'user_id'
    ];


    /**
     * Relation with users (one to many)
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation with exercises (one to many)
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
    /**
     *  Relation with answer_files (one to many)
     * @return HasMany
     */
    public function answerFiles(): HasMany
    {
        return $this->hasMany(AnswerFile::class);
    }

}
