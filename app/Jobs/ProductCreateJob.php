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

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Product::create([
            'name' => $this->data['name'],
            'image' => $this->data['image']   
        ]);
    }
}
