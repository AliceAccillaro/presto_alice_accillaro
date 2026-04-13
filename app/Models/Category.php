<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];

    public function getTranslatedNameAttribute(): string
    {
        return __("categories.{$this->name}");
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
