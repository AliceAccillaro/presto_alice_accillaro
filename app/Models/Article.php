<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id',
    ];

    // relazione con Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // relazione con User (consigliata)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}