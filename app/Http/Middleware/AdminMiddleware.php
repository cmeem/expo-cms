<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;
use App\Models\SidebarMenu;
use App\Models\WebSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminMiddleware
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
        //getting backend and general settings and informations and store them in the cache and config
        if (Auth::check() && !Cache::has('settings') && !Cache::has('admin_settings')) {
            $user_id = Auth::user()->id;
            $settings = Settings::where('admin_id', $user_id);
            $settings = Cache::remember('admin_settings', 60, function () use ($settings) {
                return $settings->pluck('value', 'key')->all();
            });
            config()->set('admin_settings', $settings);
        }else{
            config()->set('admin_settings',Cache::get('admin_settings'));
        }

        //getting backend sidebar menu and store it in the cache and config
        if (Cache::has('menu')) {
            config()->set('menu', Cache::get('menu'));
        }else{
            $parentMenu = SidebarMenu::orderBy('order', 'asc')->where('parent_id', 0)->get()->toArray();
            $subMenu = SidebarMenu::orderBy('order', 'asc')->where('parent_id','!=', 0)->get()->toArray();

            for ($i = 0; $i < sizeof($subMenu); $i++) {
                foreach ($subMenu as $key) {
                        if ($key['parent_id'] == $subMenu[$i]['id']) {
                            $subMenu[$i]['sub'][] = $key;
                        }
                }
            }
            for ($i = 0; $i < sizeof($parentMenu); $i++) {
                foreach ($subMenu as $key) {
                        if ($key['parent_id'] == $parentMenu[$i]['id']) {
                            $parentMenu[$i]['sub'][] = $key;
                        }
                }
            }
            $parentMenu = Cache::remember('menu', 60, function () use ($parentMenu) {
                return $parentMenu;
            });
            config()->set('menu', $parentMenu);
        }


        return $next($request);
    }
}
