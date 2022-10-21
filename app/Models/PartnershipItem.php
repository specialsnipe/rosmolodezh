<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnershipItem extends Model
{
    use HasFactory;

    public $fillable = [
        'title', 'body', 'image', 'partnership_id'
    ];

    public function partnership(): BelongsTo
    {
        return $this->belongsTo(Partnership::class);
    }
}
