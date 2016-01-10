<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/8/2016
 * Time: 8:17 PM
 */

namespace Eureka\Repositories;


use App\Track;
use App\User;

class TrackRepository
{

    /**
     * @var Track
     */
    private $track;
    /**
     * @var User
     */
    private $user;

    public function __construct(Track $track, User $user){
        $this->track = $track;
        $this->user = $user;
    }

    public function getTrendingTracks()
    {
        $tracks = $this->track->has('streams')->take(50)->get();
        $tracks = $tracks->sortByDesc(function($track)
        {
            return $track->streams->count();
        });
        return $tracks;
    }

    public function getAllTracksCount()
    {
        return $this->track->all()->count();
    }

    public function getArtistTrendingTracks($id)
    {
        $artist = $this->user->find($id);
        return $artist->tracks->sortDescBy(function($track){
            return $track->streams->count();
        });
    }
}