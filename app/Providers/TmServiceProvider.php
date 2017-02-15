<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\Classes\Tm;

class TmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Tm', function() {
            return new Tm();
        });
        //
    }
}
