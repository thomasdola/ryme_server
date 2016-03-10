<?php

namespace App\Listeners;

use App\Events\TrackCommented;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyCommenter
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TrackCommented  $event
     * @return void
     */
    public function handle(TrackCommented $event)
    {

    }
}
