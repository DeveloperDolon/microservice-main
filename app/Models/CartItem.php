<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'variant_id',
    ];

    public function cart()
    {   
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }

    static function boot()
    {
        static::creating((function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        }));
    }
}
