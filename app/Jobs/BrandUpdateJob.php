<?php

namespace App\Jobs;

use App\Models\Brand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class BrandUpdateJob implements ShouldQueue
{
    use Queueable;
    
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Brand::find($this->data['id'])->update([
            'name' => $this->data['name'],
            'description' => $this->data['description'],
            'location' => $this->data['location'],
            'title' => $this->data['title'],
            'logo' => $this->data['logo'],
            'banner' => $this->data['banner'],
            'created_at' => $this->data['created_at'],
            'updated_at' => $this->data['updated_at'],
        ]);
    }
}
