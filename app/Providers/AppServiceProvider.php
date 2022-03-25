<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('sha256', function ($attributes, $value) {
            return preg_match('/\b[A-Fa-f0-9]{64}\b/', $value) === 1;
        }, 'The :attribute must be a valid SHA256 hash.');
    }
}
