<?php

namespace App\Jobs;

use App\Models\Brand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class BrandCreateJob implements ShouldQueue
{
    use Queueable;

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Brand::create([
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => $this->data['description'],
            'location' => $this->data['location'],
            'title' => $this->data['title'],
            'logo' => $this->data['logo'],
            'banner' => $this->data['banner']
        ]);
    }
}
