<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'banner',
        'logo',
        'title',
        'description',
        'location',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
