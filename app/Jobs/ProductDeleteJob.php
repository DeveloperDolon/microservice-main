<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductDeleteJob implements ShouldQueue
{
    use Queueable;

    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(): void
    {
        $product = Product::find($this->id);
        if ($product) {
            $product->delete();
        }
    }
}
