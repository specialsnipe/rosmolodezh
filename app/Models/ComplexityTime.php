<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexityTime extends Model
{
    use HasFactory;

    public $fillable = [
        'started_at', 'ended_at', 'class_name'
    ];
}
