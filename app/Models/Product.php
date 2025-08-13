<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = ['id'];

    public function Category(): HasMany
    {
        return $this->hasMany(Category::class, 'id');
    }
}
