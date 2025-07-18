<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Country;
use App\Observers\CountryObserver;
use App\Models\City;
use App\Observers\CityObserver;
use Log;

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
       // Country::observe(CountryObserver::class);
       // City::observe(CityObserver::class);
    }
}
