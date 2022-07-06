<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function emails()
    {
        return $this->hasMany(SettingEmail::class);
    }
    public function phones()
    {
        return $this->hasMany(SettingPhone::class);
    }
}
