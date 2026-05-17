<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'titolo',
        'autore',
        'published_year',
        'img',
        'user_id'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
