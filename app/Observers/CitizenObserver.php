<?php

namespace App\Observers;

use App\Models\Citizen;

class CitizenObserver
{
    /**
     * Handle the Citizen "created" event.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return void
     */
    public function created(Citizen $citizen)
    {
        if($citizen->isDirty()){
            $new_email = $citizen->first_name;
            $old_email = $citizen->getOriginal('first_name');
        }
    }

    /**
     * Handle the Citizen "updated" event.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return void
     */
    public function updated(Citizen $citizen)
    {
        if($citizen->wasChanged()){

        }
    }

    /**
     * Handle the Citizen "deleted" event.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return void
     */
    public function deleted(Citizen $citizen)
    {
        //
    }

    /**
     * Handle the Citizen "restored" event.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return void
     */
    public function restored(Citizen $citizen)
    {
        //
    }

    /**
     * Handle the Citizen "force deleted" event.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return void
     */
    public function forceDeleted(Citizen $citizen)
    {
        //
    }
}
