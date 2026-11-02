<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]

class ProductCategories extends Model
{
    protected $table = 'product_categories';

    public function product():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
