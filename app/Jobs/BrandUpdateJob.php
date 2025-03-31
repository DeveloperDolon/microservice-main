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
        Brand::find($this->data['id'])->update([...$this->data]);
    }
}
