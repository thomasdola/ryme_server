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

    /**
     * @param Track $track
     * @param User $user
     */
    public function __construct(Track $track, User $user){
        $this->track = $track;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTrendingTracks()
    {
        $tracks = $this->track->has('streams')->take(50)->get();
        $tracks = $tracks->sortByDesc(function($track)
        {
            return $track->streams->count();
        });
        return $tracks->load('streams', 'artist', 'category', 'download', 'favorites', 'comments');
    }

    /**
     * @return int
     */
    public function getAllTracksCount()
    {
        return $this->track->all()->count();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTrendingTracksByArtist($id)
    {
        $tracks = $this->track->with('artist', 'favorites', 'streams', 'downloads', 'comments')
            ->where('artist_id', $id)->get();
        $tracks = $tracks->sortByDesc(function ($track) {
            return $track->streams->count();
        });
        return $tracks;
    }

    /**
     * @param $id
     * @return static
     */
    public function getTrendingTracksByCategory($id)
    {
        $tracks = $this->track->with('artist', 'favorites', 'streams', 'downloads', 'comments')
            ->where('category_id', $id)->get();
        $trendingOnes = $tracks->sortByDesc(function($track){
            return $track->streams->count();
        });
        return $trendingOnes;
    }
}