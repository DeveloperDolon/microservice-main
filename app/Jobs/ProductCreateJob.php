<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductCreateJob implements ShouldQueue
{
    use Queueable;

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $product = Product::create([
            'id' => $this->data['id'],
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

        if (isset($this->data['variants'])) {
            $variants = is_object($this->data['variants']) ?
                $this->data['variants']->toArray() :
                $this->data['variants'];

            foreach ($variants as $variant) {
                $product->variants()->create([
                    'id' => $variant['id'],
                    'name' => $variant['name'],
                    'price' => $variant['price'],
                    'stock' => $variant['stock'],
                    'created_at' => $variant['created_at'],
                    'updated_at' => $variant['updated_at'],
                ]);
            }
        }
    }
}
