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

/**
 * Class TrackRepository
 * @package Eureka\Repositories
 */
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
     * @var ArtistRepository
     */
    private $artistRepository;

    /**
     * @param Track $track
     * @param User $user
     */
    public function __construct(Track $track, User $user, ArtistRepository $artistRepository){
        $this->track = $track;
        $this->user = $user;
        $this->artistRepository = $artistRepository;
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
        $artist = $this->artistRepository->getArtist($id);
        $tracks = $this->track->with('artist', 'favorites', 'streams', 'downloads', 'comments')
            ->where('artist_id', $artist->id)->get();
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

    /**
     * @param $trackId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getTrackWithRelations($trackId)
    {
        return $this->track
            ->with('author', 'usersWhoDownloaded', 'usersWhoLiked',
                'comments', 'genre', 'streams', 'cover', 'file')
            ->where('uuid', $trackId)
            ->first();
    }

    /**
     * @param $trackId
     * @return mixed
     */
    public function getTrack($trackId)
    {
        return $this->track->where('uuid', $trackId)->first();
    }

    /**
     * @param $artistId
     * @return mixed
     */
    public function getAllTracksByArtist($artistId)
    {
        $artist = $this->user->where('uuid', $artistId)->first();
        return $artist->uploadedTracks;
    }
}