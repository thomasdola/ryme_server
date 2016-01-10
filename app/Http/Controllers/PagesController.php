<?php

namespace App\Http\Controllers;

use Eureka\Repositories\AdRepository;
use Eureka\Repositories\ArtistRepository;
use Eureka\Repositories\TrackRepository;
use Eureka\Repositories\UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ArtistRepository
     */
    private $artistRepository;
    /**
     * @var AdRepository
     */
    private $adRepository;
    /**
     * @var TrackRepository
     */
    private $trackRepository;

    /**
     * @param UserRepository $userRepository
     * @param ArtistRepository $artistRepository
     * @param AdRepository $adRepository
     * @param TrackRepository $trackRepository
     */
    public function __construct(UserRepository $userRepository, ArtistRepository $artistRepository,
                                AdRepository $adRepository, TrackRepository $trackRepository){
        $this->userRepository = $userRepository;
        $this->artistRepository = $artistRepository;
        $this->adRepository = $adRepository;
        $this->trackRepository = $trackRepository;
    }
    public function dashboard()
    {
        $allUsersCount = $this->userRepository->getAllUsersCount();
        $allArtistsCount = $this->artistRepository->getAllArtistsCount();
        $allTracksCount = $this->trackRepository->getAllTracksCount();
        $allActiveAdsCount = $this->adRepository->getAllActiveAdsCount();
        $trendingArtists = $this->artistRepository->getTrendingArtists();
        $trendingTracks = $this->trackRepository->getTrendingTracks();

        return view('pages.welcome', [
            'totalUsers'=>$allUsersCount,
            'totalArtists'=>$allArtistsCount,
            'totalTracks'=>$allTracksCount,
            'totalActiveAds'=>$allActiveAdsCount,
            'trendingTracks'=>$trendingTracks,
            'trendingArtists'=>$trendingArtists
        ]);
    }
}
