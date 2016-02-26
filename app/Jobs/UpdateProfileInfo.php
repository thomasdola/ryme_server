<?php

namespace App\Jobs;

use App\Jobs\Job;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProfileInfo extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var array
     */
    private $info;

    /**
     * Create a new job instance.
     *
     * @param array $info
     */
    public function __construct(array $info)
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $userActivity->updateProfileInfo($this->info);
    }
}
