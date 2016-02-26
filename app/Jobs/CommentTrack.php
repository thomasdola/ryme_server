<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Track;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CommentTrack
 * @package App\Jobs
 */
class CommentTrack extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Track
     */
    private $track;
    /**
     * @var string|string
     */
    private $body;

    /**
     * Create a new job instance.
     *
     * @param Track $track
     * @param mixed $body
     */
    public function __construct(Track $track, string $body)
    {
        $this->track = $track;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $userActivity->commentTrack($this->track, $this->body);
    }
}
