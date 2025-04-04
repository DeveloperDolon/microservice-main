<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductUpdateJob implements ShouldQueue
{
    use Queueable;

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Product::find($this->data['id'])->update([
            'name' => $this->data['name'],
            'images' => $this->data['images'],
            'discount' => $this->data['discount'],
            'price' => $this->data['price'],
            'description' => $this->data['description'],
            'discount_type' => $this->data['discount_type'],
            'likes' => $this->data['likes'],
            'ingredients' => $this->data['ingredients'],
            'shipping_cost' => $this->data['shipping_cost'],
            'benefit' => $this->data['benefit'],
            'seller_id' => $this->data['seller_id'],
            'brand_id' => $this->data['brand_id'],
            'created_at' => $this->data['created_at'],
            'updated_at' => $this->data['updated_at'],
        ]);
    }
}
