<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Hanya paksa HTTPS jika diakses lewat Pinggy/Internet
        if (str_contains(request()->getHost(), 'pinggy') || request()->isSecure()) {
            URL::forceScheme('https');
    }
    }
}
