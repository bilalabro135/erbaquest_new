<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use App\Models\Menu;
use App\Models\GlobalSettings;
use View;
use Illuminate\Support\Facades\Schema;
use Auth;

class SettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('settings')) {
            $this->app->singleton('App\Models\GlobalSettings', function ($app) {
                return new GlobalSettings(Settings::where('id', '=', 1 )->first());
            });
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot( )
    {    
        if (Schema::hasTable('settings')) {   
            $settinsInstance = new GlobalSettings(Settings::where('id', '=', 1 )->first());
            View::share('globalsettings', $settinsInstance);

            $route = explode('/',$this->app->request->getRequestUri());
            if (!in_array('admin', $route)) {


                 $primarymenu = Menu::where('type', 'primary')->orderBy('order', 'ASC')->get();
                 View::share('primarymenu', $primarymenu);
                 $topbar = Menu::where('type', 'topbar')->where('parent_id', null)->orderBy('order', 'ASC')->get();
                 View::share('topbar', $topbar);
                 $quicklinks = Menu::where('type', 'quicklinks')->orderBy('order', 'ASC')->get();
                 View::share('quicklinks', $quicklinks);
                 $socialmedia = new GlobalSettings(Settings::where('name', '=', 'socialmedia' )->first());
                 View::share('socialmedialinks', $socialmedia);
            }
        }
    }
}
