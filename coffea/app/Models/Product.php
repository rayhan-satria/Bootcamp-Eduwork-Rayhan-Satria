<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategories;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['category_id', 'name', 'slug', 'description', 'price', 'stock', 'image',])]

class Product extends Model
{
    public function category():BelongsTo
    {
        return $this->belongsTo(ProductCategories::class);
    }

    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItems::class);
    }

    public function carts() : HasMany 
    {
        return $this->hasMany(Carts::class);
    }
}
