<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 7:56 AM
 */

namespace Eureka\Services\Interfaces;


use App\User;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ArtistContract
{
    /**
     * @param Collection $TaggedTrackData
     * @param User $artist
     * @return mixed
     */
    public function uploadTrack(Collection $TaggedTrackData, User $artist);

    /**
     * @param UploadedFile $photo
     * @param User $artist
     * @return mixed
     */
    public function updateBackgroundPhoto(UploadedFile $photo, User $artist);

    /**
     * @param string $name
     * @param User $artist
     * @return mixed
     */
    public function updateStageName($name, User $artist);
}