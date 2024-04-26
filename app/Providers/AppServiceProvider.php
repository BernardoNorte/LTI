<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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
        Config::set('custom.router_ip', '192.168.1.143');
        Config::set('custom.loginName', 'admin');
        Config::set('custom.loginPassword', 'ltipassword');
    }
}
