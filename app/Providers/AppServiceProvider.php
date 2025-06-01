<?php

namespace App\Providers;

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
        if (!function_exists('toRupiah')) {
            function toRupiah($number)
            {
                return 'Rp ' . number_format($number, 0, ',', '.');
            }
        }
    }
}
