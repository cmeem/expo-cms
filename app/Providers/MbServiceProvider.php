<?php

namespace App\Providers;


use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class MbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Settings::where('admin_id', 0)->pluck('value', 'key')->all();
        config()->set('settings', $settings);
    }
}
