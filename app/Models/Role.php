<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [
        'name'
    ];

    protected $appends = [
        'rus_name'
    ];

    public function getRusNameAttribute()
    {
        if ($this->name == 'admin') return 'Администратор';
        if ($this->name == 'teacher') return 'Учитель';
        if ($this->name == 'tutor') return 'Куратор';
        if ($this->name == 'student') return 'Студент';
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
