<?php

namespace App\Providers;

//Kalau pas migrate error aktifkan Schema
//use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        //Gunakan Schema dalam boot
        //Schema::defaultStringLength(191);
    }
}
