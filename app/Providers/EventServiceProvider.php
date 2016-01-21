<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserJoined' => [
            'App\Listeners\HandleUser',
        ],
        'App\Events\VouchRequestSent' => [
            'App\Listeners\HandleRequest',
        ],
        'App\Events\ArtistJoined' => [
            'App\Listeners\HandleArtist',
        ],
        'App\Events\TrackUploaded' => [
            'App\Listeners\HandleTrack',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
