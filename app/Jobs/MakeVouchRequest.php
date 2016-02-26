<?php

namespace App\Jobs;

use App\Events\VouchRequestSent;
use App\Jobs\Job;
use Eureka\Services\Interfaces\VouchServiceInterface;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mockery\Exception;

class MakeVouchRequest extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = collect($data);
    }

    /**
     * Execute the job.
     *
     * @param VouchServiceInterface $vouchService
     */
    public function handle(VouchServiceInterface $vouchService)
    {
        try{
            $vouch = $vouchService->makeRequest();
        }catch (\Exception $e){
            throw new Exception('User Not Allowed to Make a new Request');
        }
        $this->updateUser();
        //Emit the Event
        event()->fire(new VouchRequestSent($vouch));
    }

    private function updateUser()
    {
        $this->auth->user()->update([
            'stage_name' => $this->data->get('stage_name'),
            'is_request_active' => true
        ]);
    }
}
