<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'images',
        'discount',
        'price',
        'description',
        'discount_type',
        'likes',
        'ingredients',
        'shipping_cost',
        'benefit',
        'seller_id',
        'brand_id'
    ];
}
