<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/21/2016
 * Time: 12:09 PM
 */

namespace Eureka\Services\App;


use App\User;
use Eureka\Services\Interfaces\ArtistContract;
use Eureka\Services\Interfaces\string;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webpatser\Uuid\Uuid;

class ArtistActivitiesService implements ArtistContract
{
    private $artist;

    /**
     *
     */
    public function __construct()
    {
        $this->artist = Auth::user();
    }

    /**
     * @param Collection $TaggedTrackData
     * @param User $artist
     * @return mixed
     */
    public function uploadTrack(Collection $TaggedTrackData, User $artist)
    {
        $data = $this->constructDataToBeSaved($this->getDataFromSession(), $TaggedTrackData);
        //save track info to our local database
//        $track = $this->artist->uploadedTracks()->create($data);
        //upload the track to the cloud
//        $track_path = aws.upload($trackFile);
//        $cover_path = aws.upload($trackCover);
//        $track->file()->create(['path'=>$track_path]);
//        $track->photo()->create(['path'=>$cover_path]);
        return $data;
    }

    /**
     * @param UploadedFile $photo
     * @param User $artist
     * @return mixed
     */
    public function updateBackgroundPhoto(UploadedFile $photo, User $artist)
    {
        // TODO: Implement updateBackgroundPhoto() method.
    }

    /**
     * @param string $name
     * @param User $artist
     * @return mixed
     */
    public function updateStageName($name, User $artist)
    {
        // TODO: Implement updateStageName() method.
    }

    private function getDataFromSession()
    {
        return session()->pull('audioData');
    }

    private function constructDataToBeSaved($data, $taggedTrackData)
    {
        $uuid = Uuid::generate(4);
        $data = array_add($data, 'uuid', $uuid);
        $data = $taggedTrackData->merge($data);
        return $data;
    }
}