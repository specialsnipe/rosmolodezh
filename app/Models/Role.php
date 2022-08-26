<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    const STUDENT = 1;
    const TUTOR = 2;
    const TEACHER = 3;
    const ADMIN = 4;

    protected $fillable = [
        'name',
        'readable_name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


}
