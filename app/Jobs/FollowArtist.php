<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Eureka\Services\Interfaces\UserContract;
use Exception;
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
     * @param User $user
     */
    public function __construct(User $artist, User $user)
    {
        $this->artist = $artist;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     * @throws Exception
     */
    public function handle(UserContract $userActivity)
    {
        try{
            $userActivity->followArtist($this->artist, $this->user);
        }catch (Exception $e){
            throw $e;
        }
    }
}
