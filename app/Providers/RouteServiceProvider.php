<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        $this->configureRateLimiting();
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapConsoleRoutes();
    }

    // Optionally map API routes
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['throttle:api'])
            ->group(function () {
                Route::middleware(['api'])
                ->prefix('v1')
                ->namespace($this->namespace)
                ->group(function() {
                    require base_path('routes/api.php');
                    require base_path('routes/auth.php');
                });
            });
    }

    protected function mapConsoleRoutes()
    {
        Route::group([
            'prefix' => 'console',
        ], function () {
            require base_path('routes/console.php');
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
