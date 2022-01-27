<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use App\Models\GlobalSettings;
use View;
use Illuminate\Support\Facades\Schema;

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
        }
    }
}
