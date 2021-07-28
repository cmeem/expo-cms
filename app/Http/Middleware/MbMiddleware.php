<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;
use App\Models\SidebarMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MbMiddleware
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

        if (Auth::check() && !Cache::has('settings')) {
            $user_id = Auth::user()->id;
            $settings = Settings::where('admin_id', $user_id);
            $settings = Cache::remember('settings', 60, function () use ($settings) {
                return $settings->pluck('value', 'key')->all();
            });
            config()->set('settings', $settings);
        }else{
            config()->set('settings',Cache::get('settings'));
        }

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
        // dd(config('menu'), Config('settings'));
        return $next($request);
    }
}
