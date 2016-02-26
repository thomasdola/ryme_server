<?php

namespace App\Jobs;

use App\Event;
use App\Jobs\Job;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewEvent extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Event
     */
    private $eventAd;

    /**
     * Create a new job instance.
     *
     * @param Event $eventAd
     */
    public function __construct(Event $eventAd)
    {
        //
        $this->eventAd = $eventAd;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $userActivity->viewEvent($this->eventAd);
    }
}
