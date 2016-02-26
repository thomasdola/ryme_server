<?php

namespace App\Jobs;

use App\User;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnfollowArtist extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
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
        $this->artist = $artist;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $userActivity->unFollowArtist($this->artist);
    }
}
