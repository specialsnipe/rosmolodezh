<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complexity extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'level', 'body'
    ];

    /**
     * Get all of the exercises for the Complexity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
