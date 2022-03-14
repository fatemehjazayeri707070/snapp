<?php
namespace App\Models;
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::if('admins', function () {
            return auth()->check() && (auth()->user()->role=='admin' || auth()->user()->role=='shop');
        });
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role=='admin';
        });
        Blade::if('shop', function () {
            return auth()->check() && auth()->user()->role=='shop';
        });
        Blade::if('user', function () {
            return auth()->check() && auth()->user()->role=='user';
        });
    }
}
