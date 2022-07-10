<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'answer_files';
    protected $fillable = [
        'answer_id',
        'file_name',
        'type'
    ];

    /**
     * Relation with answers (one to many)
     * @return BelongsTo
     */
    public function answer():BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
