<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('unique_promo', function ($attribute, $value, $parameters, $validator) {
            $file = storage_path('app/data/promo.json');
            $promos = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
            foreach ($promos as $promo) {
                if (strtoupper($promo['code']) === strtoupper($value)) {
                    return false;
                }
            }
            return true;
        }, 'Kode promo sudah digunakan.');
    }
}
