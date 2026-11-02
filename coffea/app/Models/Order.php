<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('order_number', 'user_id', 'product_id', 'quantity', 'total', 'status')]

class Order extends Model
{
    public function order_number() : BelongsTo 
    {
        return $this->belongsTo(OrderItems::class);    
    }

    public function user() : HasMany 
    {
        return $this->hasMany(User::class);    
    }
}
