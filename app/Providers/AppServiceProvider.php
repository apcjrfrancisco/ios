<?php

namespace App\Providers;

use App\Models\Footer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

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
        /** to-do: change code causes problems when installing the app**/
        if (! App::runningInConsole()) {
            // your code
            $websiteSetting = Footer::first();   
        }
        else {
            $websiteSetting = null;
        }
        View::share('appSetting', $websiteSetting);
        // add Str::currency macro
        Str::macro('currency', function ($price) {
            return number_format($price, 2, '.', ',');
        });
    }
}
