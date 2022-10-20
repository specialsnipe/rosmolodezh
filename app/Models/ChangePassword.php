<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangePassword extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'token',
        'expiration_min'
    ];
    protected $table = 'change_password';
}
