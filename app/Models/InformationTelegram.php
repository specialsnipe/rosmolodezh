<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationTelegram extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'description', 'information_id'
    ];

    public function setting()
    {
        return $this->belongsTo(Information::class);
    }
}
