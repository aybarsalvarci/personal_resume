<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(Schema::hasTable('settings')){
            $settings = Cache::remember('general_settings', 60 * 60 * 24, function () {
                return Setting::first();
            });

            if ($settings) {
                foreach ($settings->toArray() as $key => $value) {
                    Config::set("settings.{$key}", $value);
                }
            }
        }
    }
}
