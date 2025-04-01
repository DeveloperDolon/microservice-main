<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
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
        'brand_id',
        'created_at',
        'updated_at',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variants() 
    {
        return $this->hasMany(Variant::class, 'product_id');
    }
}
