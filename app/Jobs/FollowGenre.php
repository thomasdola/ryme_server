<?php

namespace App\Jobs;

use App\Category;
use App\Jobs\Job;
use App\User;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FollowGenre extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Category
     */
    private $genre;

    /**
     * Create a new job instance.
     *
     * @param Category $genre
     * @param User $user
     */
    public function __construct(Category $genre, User $user)
    {
        $this->genre = $genre;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     * @throws \Exception
     */
    public function handle(UserContract $userActivity)
    {
        try{
            $userActivity->followCategory($this->genre, $this->user);
        }catch (\Exception $e){
            throw $e;
        }
    }
}
