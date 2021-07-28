<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        Validator::extend('letters_only', function($attr, $value){
            return preg_match('/^[a-zA-Z]/u', $value);
        });
        Validator::extend('digits_only', function($attr, $value){
            return preg_match('/^[0-9]/u', $value);
        });
        Validator::extend('phone_number', function($attr, $value){
            return preg_match('/^[0-9]*$/', $value);
        });

        Schema::defaultStringLength(125);

    }
}
