<?php

namespace App\Jobs;


use App\User;
use Eureka\Services\Interfaces\ArtistContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateBackPicture extends AppApiJobs implements ShouldQueue
{
    /**
     * @var UploadedFile
     */
    private $file;
    /**
     * @var User
     */
    private $artist;

    /**
     * @param UploadedFile $file
     * @param User $artist
     */
    public function __construct(UploadedFile $file, User $artist){
        $this->file = $file;
        $this->artist = $artist;
    }

    public function handle(ArtistContract $artistActivity)
    {
        try{
            $artistActivity->updateBackgroundPhoto($this->file, $this->user);
        }catch (\Exception $e){
            throw $e;
        }
    }
}