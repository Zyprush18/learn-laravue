<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $table = 'category';
    protected $guarded = ['id'];


    public function Products() :BelongsTo
    {
        return $this->belongsTo(Product::class, 'category_id');
    }
}
