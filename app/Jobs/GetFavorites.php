<?php

namespace App\Jobs;

use App\Jobs\Job;
use Eureka\Repositories\UserRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GetFavorites extends AppApiJobs implements ShouldQueue
{
    private $user;
    use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    private $type;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new job instance.
     * @param $type
     * @param UserRepository $userRepository
     */
    public function __construct($type, UserRepository $userRepository)
    {
        $this->type = $type;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [];
        $this->user = $this->auth->user();
        if ( $this->type == 'tracks'){
            $data = $this->userRepository->getFavoriteTracksFor($this->user);
        }elseif( $this->type == 'artists'){
            $data = $this->userRepository->getFavoriteArtistsFor($this->user);
        }
        return $data;
    }
}
