<?php

namespace App\Observers;

use App\Models\City;
use App\Models\Country;
use Log;

class CityObserver
{
    /**
     * Handle the City "created" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function created(City $city)
    {
        //
    }

    /**
     * Handle the City "updated" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function updated(City $city)
    {
       Log::info($city->country_id);
            Country::where('id',$city->country_id)->update([
                  'country_status'=> '1'
                ]);
       
    }

    /**
     * Handle the City "deleted" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function deleted(City $city)
    {
        //
    }

    /**
     * Handle the City "restored" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function restored(City $city)
    {
        //
    }

    /**
     * Handle the City "force deleted" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        //
    }
}
