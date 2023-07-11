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
            if(Footer::get()->isEmpty()){
                Footer::create([
                    'company_name' => env('COMPANY_NAME', ''),
                    'company_description' => env('COMPANY_DESCRIPTION', ''),
                    'company_address' => env('COMPANY_ADDRESS', ''),
                    'company_phone' => env('COMPANY_PHONE', ''),
                    'company_email' => env('COMPANY_ADDRESS', ''),
                    'company_facebook' => env('COMPANY_EMAIL', ''),
                    'created_by' => env('CREATED_BY', 0),
                    'updated_by' => env('UPDATED_BY', 0),
                ]);
            }
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
