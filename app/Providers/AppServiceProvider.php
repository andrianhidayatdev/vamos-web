<?php

namespace App\Providers;

use App\Http\Services\KategoriService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('produk', function ($attribute, $value, $parameters, $validator) {
            // Logika validasi custom untuk produk
            // Misalnya, pastikan nama produk unik di database
            return !\App\Models\Produk::where($parameters[0], $value)->exists();
        }, 'Produk :attribute sudah ada.');
    }
}
