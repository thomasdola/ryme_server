<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/8/2016
 * Time: 8:16 PM
 */

namespace Eureka\Repositories;


use App\User;
use Carbon\Carbon;

class ArtistRepository
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var VouchRepository
     */
    private $vouchRepository;

    /**
     * @param User $user
     * @param VouchRepository $vouchRepository
     */
    public function __construct(User $user, VouchRepository $vouchRepository){
        $this->user = $user;
        $this->vouchRepository = $vouchRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTrendingArtists()
    {
        $artists = $this->user
            ->with(['photos', 'tracks', 'followers'])
            ->has('tracks')
            ->get();
//        $artists = $artists->sortByDesc(function($artist)
//        {
//            return $artist->followers->count();
//        });
        return $artists->take(50);
    }

    public function getTrendingArtistsByCategory($id)
    {
        $artists = $this->user->with('tracks', 'photos', 'category', 'followers')
            ->has('tracks')->where('category_id', $id)->get();
        $trendingOnes = $artists->sortByDesc(function($artist){
            return $artist->followers->count();
        });
        return $trendingOnes;
    }

    /**
     *
     */
    public function getAllArtistsCount()
    {
        return $this->user->where('is_artist', true)->count();
    }

    public function getAllArtists()
    {
        return $this->user->where('is_artist', true)->get();
    }

    public function getArtistToBe()
    {
        $req = $this->vouchRepository->getRecentRequests();
        return $req->load('user');
    }

    public function getArtistJoinedTodayCount()
    {
        return $this->getRecentJoinedArtists(Carbon::now()->startOfDay(),
            Carbon::now()->endOfDay())
            ->count();
    }

    public function getArtistsJoinedThisWeekCount()
    {
        $startDate = Carbon::now()->subWeek()->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        return $this->getRecentJoinedArtists($startDate, $endDate)
            ->count();
    }

    private function getRecentJoinedArtists($startDate, $endDate)
    {
        return $this->user->where('is_artist', true)
            ->whereBetween('artist_on', [$startDate, $endDate])
            ->orderBy('artist_on', 'desc')
            ->get();
    }

    public function getArtistsJoinedThisMonthCount()
    {
        $startDate = Carbon::now()->subMonth()->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        return $this->getRecentJoinedArtists($startDate, $endDate)
            ->count();
    }

    public function getArtistWithRelations($id)
    {
        return $this->user->with('photos', 'uploadedTracks', 'followers', 'category', 'channel')
            ->where('uuid', $id)->first();
    }

    public function getArtist($id)
    {
        return $this->user->where('uuid', $id)->first();
    }
}