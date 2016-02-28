<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FollowArtist extends AppApiJobs implements ShouldQueue
{
    /**
     * @var User
     */
    private $artist;

    /**
     * Create a new job instance.
     *
     * @param User $artist
     */
    public function __construct(User $artist)
    {
        //
        $this->artist = $artist;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $userActivity->followArtist($this->artist);
    }
}
