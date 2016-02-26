<?php

namespace App\Jobs;

use App\Events\VouchWasAnswered;
use App\Jobs\Job;
use App\Vouch;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnswerVouch extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Vouch
     */
    private $vouchRequest;
    /**
     * @var boolean
     */
    private $answer;

    /**
     * Create a new job instance.
     *
     * @param Vouch $vouchRequest
     * @param boolean $answer
     */
    public function __construct(Vouch $vouchRequest, boolean $answer)
    {
        $this->vouchRequest = $vouchRequest;
        $this->answer = $answer;
    }

    /**
     * Execute the job.
     *
     * @param UserContract $userActivity
     */
    public function handle(UserContract $userActivity)
    {
        $vouchAnswer = $userActivity->answerVouch($this->vouchRequest, $this->answer);
        //fire an event
        event()->fire(new VouchWasAnswered($vouchAnswer));
    }
}
