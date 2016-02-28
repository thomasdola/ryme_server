<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateProfilePicture extends AppApiJobs implements ShouldQueue
{
    /**
     * @var
     */
    private $photo_full_path;

    /**
     * Create a new job instance.
     *
     * @param $photo_full_path
     * @param User $user
     */
    public function __construct($photo_full_path, User $user)
    {
        $this->user = $user;
        $this->photo_full_path = $photo_full_path;
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
            $userActivity->updateProfilePicture($this->photo_full_path, $this->user);
        }catch (\Exception $e){
            throw $e;
        }
    }
}
