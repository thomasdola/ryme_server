<?php

namespace App\Listeners;

use App\Events\VouchRequestWasDue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConductFinalVerdict
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VouchRequestWasDue  $event
     * @return void
     */
    public function handle(VouchRequestWasDue $event)
    {
        //
    }
}
