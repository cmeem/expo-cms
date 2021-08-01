<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\WebSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Cache::has('web_settings')) {
            $settings = WebSettings::all();
            $settings = Cache::remember('web_settings', 60*24*7 , function () use ($settings) {
                return $settings->pluck('value', 'key')->toArray();
            });
            config()->set('web_settings', $settings );
        }else{
            config()->set('web_settings',Cache::get('web_settings'));
        }
        return $next($request);
    }
}
