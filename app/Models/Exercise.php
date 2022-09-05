<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use HasFactory, SoftDeletes,  Filterable;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'user_id',
        'block_id',
        'complexity_id',
        'active',
        'time',
    ];

    protected $appends = [
//        'complexityClassName',
//        'complexityTimeClassName',
//        'name_minute_count',
//        'answers_added_count',
//        'academic_performance_percent',
//        'average_score',
//        'mark_count'
    ];
    protected $with = [
      'answers'
    ];


    public function getComplexityClassNameAttribute()
    {

        return Complexity::where('id', $this->complexity_id)
            ->first()
            ->class_name;
    }
    public function getComplexityTimeClassNameAttribute()
    {
        $time = ComplexityTime::where('started_at','<=', $this->time)
        ->where('ended_at','>=', $this->time)
        ->first();

        return ComplexityTime::where('started_at','<=', $this->time)
                ->where('ended_at','>=', $this->time)
                ->first()
                ? ComplexityTime::where('started_at','<=', $this->time)
                    ->where('ended_at','>=', $this->time)
                    ->first()->class_name
                : 'dark';

    }

    public function getNameMinuteCountAttribute()
    {

        $finished = $this->time % 10;
        $last = 'минут';

        if ($finished === 1 ) {
            $last = 'минута';
        }
        if ($finished === 2 || $finished === 3 || $finished === 4) {
            $last = 'минуты';
        }
        if($this->time == 11 ||$this->time == 12 ||$this->time == 13 ||$this->time == 14 ) {
            $last = 'минут';
        }

        return $last;
    }

    public function getAnswersAddedCountAttribute()
    {
        return Answer::where('exercise_id', $this->id)->get()->count();
    }
    public function getMarkCountAttribute()
    {
        return Answer::where('exercise_id', $this->id)->whereNotNull('mark')->get()->count();
    }

    public function getAcademicPerformancePercentAttribute()
    {
        $positive_ratings = 0;
        $answers = Answer::where('exercise_id', $this->id)->get();
        foreach ($answers as $answer) {
            if($answer->mark >= 3) {
                $positive_ratings++;
            }
        }
        $users_count = $this->block->track->users()->count();
        if ($users_count === 0) {
            return 0;
        }
        return round($positive_ratings*100/$users_count, 1);
    }
    public function getAverageScoreAttribute()
    {
        $score = 0;
        $i =0;
        $answers = Answer::where('exercise_id', $this->id)->get();
        foreach ($answers as $answer) {
            if($answer->mark) {
                $score += $answer->mark;
                $i++;
            }
        }
        if ($i === 0) {
            return 0;
        }
        return round($score/$i, 1);
    }
    /**
     *  Relation with users (one to many)
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }
    /**
     *  Relation with users (one to many)
     * @return HasMany
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the complexity that owns the Exercise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complexity(): BelongsTo
    {
        return $this->belongsTo(Complexity::class);
    }

    /**
     *  Relation with blocks (one to many)
     * @return BelongsTo
     */
    public function block(): belongsTo
    {
        return $this->belongsTo(Block::class);
    }


    /**
     *  Relation with answers (one to many)
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     *  Relation with videos (one to many)
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Relation with links (one to many)
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Relation with files (one to many)
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

}
