<?php

namespace App\Jobs;

use App\Jobs\Job;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateProfilePicture extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var UploadedFile
     */
    private $photo;

    /**
     * Create a new job instance.
     *
     * @param UploadedFile $photo
     */
    public function __construct(UploadedFile $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $userActivity->updateProfilePicture($this->photo);
    }
}
