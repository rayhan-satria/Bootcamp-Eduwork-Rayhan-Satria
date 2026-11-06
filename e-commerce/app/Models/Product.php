<?php

namespace App\Models;

use App\Models\ProductCategory;
use App\Models\CartItems;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category(): BelongsTo 
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');    
    }

    public function cartItems(): HasMany 
    {
        return $this->hasMany(CartItems::class);    
    }

    public function orderItems(): HasMany 
    {
        return $this->hasMany(OrderItem::class);    
    }
}
