<?php

namespace App\Providers;

use App\Jobs\BrandCreateJob;
use App\Jobs\BrandDeleteJob;
use App\Jobs\BrandUpdateJob;
use App\Jobs\ProductCreateJob;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::bindMethod(ProductCreateJob::class . '@handle', fn($product) => $product->handle());
        App::bindMethod(BrandCreateJob::class . '@handle', fn($brand) => $brand->handle());
        App::bindMethod(BrandUpdateJob::class, '@handle', fn($brand) => $brand->handle());
        App::bindMethod(BrandDeleteJob::class, '@handle', fn($brand) => $brand->handle());
    }
}
