<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = config('settings.settings');

        foreach ($settings as $key => $setting_V){
            $setting = new Settings();
            $setting->name = $key;
            $setting->value = serialize($setting_V);
            $setting->save();
        }
    }
}
