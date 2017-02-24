<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Tm;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * 自定义验证
         * tm class 在app/custom/classes下
         */
        Validator::extend('tm_team_id_valid', function($attribute, $value, $parameters, $validator)
        {
            return Tm::tmTeamIdValid($value);
        });
        Validator::extend('tm_match_id_valid', function($attribute, $value, $parameters, $validator)
        {
            return Tm::tmMatchIdValid($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        /*if ($this->app->environment() == 'local') {
            // $this->app->register('Laracasts\Generators\GeneratorsServiceProvider'); // you're using Jeffrey way's generators, too, right?
            $this->app->register('Backpack\Generators\GeneratorsServiceProvider');
        }
        */
        $this->app->register('Backpack\Generators\GeneratorsServiceProvider');
    }
}
