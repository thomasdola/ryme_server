<?php

namespace App\Jobs;

use App\Events\VouchWasAnswered;
use App\Jobs\Job;
use App\User;
use App\Vouch;
use Eureka\Services\Interfaces\UserContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnswerVouch extends AppApiJobs implements ShouldQueue
{
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
     * @param $answer
     * @param User $user
     */
    public function __construct(Vouch $vouchRequest, $answer, User $user)
    {
        $this->vouchRequest = $vouchRequest;
        $this->answer = $answer;
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
            $vouchAnswer = $userActivity->answerVouch($this->vouchRequest,
                $this->answer, $this->user);
//            event()->fire(new VouchWasAnswered($vouchAnswer));
        }catch (\Exception $e){
            throw $e;
        }
    }
}
