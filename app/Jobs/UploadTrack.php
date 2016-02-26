<?php

namespace App\Jobs;

use Eureka\Services\Interfaces\ArtistContract;
use Eureka\Services\Interfaces\TrackTagServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UploadTrack extends AppApiJobs implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Collection
     */
    private $audioData;

    /**
     * Create a new job instance.
     *
     * @param Collection $audioData
     */
    public function __construct(Collection $audioData)
    {
        $this->audioData = $audioData;
    }

    /**
     * Execute the job.
     *
     * @param TrackTagServiceInterface $trackTagger
     * @param ArtistContract $artistActivity
     */
    public function handle(TrackTagServiceInterface $trackTagger, ArtistContract $artistActivity)
    {

        //save some of the data to session
        $this->saveDataToSession();
        //Set the appropriate tags on the track
        $trackData = $trackTagger->using($this->audioData);
        //Now , let's upload the track
        $track = $artistActivity->uploadTrack($trackData);
        dd($track);
        //fire an event
//        event()->fire(new TrackUploaded($track));
    }

    protected function saveDataToSession()
    {
        session()->put('audioData', [
            'released_date' => $this->audioData->get('released_date'),
            'title' => $this->audioData->get('title'),
            'category_id' => $this->audioData->get('category_id')
        ]);
    }
}
