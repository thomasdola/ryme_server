<?php

namespace App\Jobs;

use App\User;
use Eureka\Services\Interfaces\UserContract;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnfollowArtist extends AppApiJobs implements ShouldQueue
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
            $userActivity->unFollowArtist($this->artist, $this->user);
        }catch (Exception $e){
            throw $e;
        }
    }
}
