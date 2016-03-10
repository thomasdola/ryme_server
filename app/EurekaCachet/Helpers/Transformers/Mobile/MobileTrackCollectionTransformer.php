<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 2/28/2016
 * Time: 2:37 PM
 */

namespace Eureka\Helpers\Transformers\Mobile;


use App\Track;
use App\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class MobileTrackCollectionTransformer extends TransformerAbstract
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user){
        $this->user = $user;
    }
    public function transform(Track $track){
        return [
            "title" => $track->title,
            "artist_name" => $track->author->stage_name,
            "released_date" => Carbon::parse($track->released_date)->timestamp * 1000,
            "downloads" => $track->usersWhoDownloaded->count(),
            "likes" => $track->usersWhoLiked->count(),
            "streams" => $track->streams->count(),
            "comments" => $track->comments->count(),
            "artistId" => $track->author->uuid,
            "uuid" => $track->uuid,
            "cover" => "http://localhost:8000" . $track->cover->path,
            "path" => "http://localhost:8000" . $track->file->path,
            "trackExt" => $track->file->extension,
            "coverExt" => $track->cover->extension,
            "duration" => $track->length,
            "downloadable" => (boolean)$track->downloadable,
            "downloaded" => $this->downloaded($track),
            "amTheOwner" => $this->amITheOwner($track),
            "liked" => $this->liked($track),
            "firstAd" => null,
            "secondAd" => null,
        ];
    }

    /**
     * @param Track $track
     * @return bool
     */
    private function downloaded(Track $track)
    {
        $user = $track->usersWhoDownloaded->where("user_id", (string)$this->user->id)->first();
        if($user != null){
            return true;
        }
        return false;
    }

    /**
     * @param Track $track
     * @return bool
     */
    private function amITheOwner(Track $track)
    {
        if($track->author->uuid == $this->user->uuid){
            return true;
        }
        return false;
    }

    /**
     * @param Track $track
     * @return bool
     */
    private function liked(Track $track)
    {
        if($track->usersWhoLiked->where("user_id", (string)$this->user->id)->first() != null){
            return true;
        }
        return false;
    }
}