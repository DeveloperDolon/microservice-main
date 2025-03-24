<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'quantity',
        'price',
        'discount_amount',
        'customer_id',
        'coupon_applied',
        'coupon_code',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }   

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    static function boot()
    {
        static::creating((function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        }));
    }
}
