<?php

namespace App\Http\Controllers;

use Eureka\Repositories\ArtistRepository;
use Eureka\Repositories\TrackRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtistsController extends Controller
{

    /**
     * @var ArtistRepository
     */
    private $artistRepository;
    /**
     * @var TrackRepository
     */
    private $trackRepository;

    /**
     * @param ArtistRepository $artistRepository
     * @param TrackRepository $trackRepository
     */
    public function __construct(ArtistRepository $artistRepository,
                                TrackRepository $trackRepository){
        $this->artistRepository = $artistRepository;
        $this->trackRepository = $trackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artistsJoinedToday = $this->artistRepository->getArtistJoinedTodayCount();
        $artistsJoinedThisWeek = $this->artistRepository->getArtistsJoinedThisWeekCount();
        $artistsJoinedThisMonth = $this->artistRepository->getArtistsJoinedThisMonthCount();
        $allArtistsCount = $this->artistRepository->getAllArtistsCount();
        $artistsToBe = $this->artistRepository->getArtistToBe();
        return view('artists.index', [
            'joinedToday'=>$artistsJoinedToday,
            'joinedThisWeek'=>$artistsJoinedThisWeek,
            'joinedThisMonth'=>$artistsJoinedThisMonth,
            'total'=>$allArtistsCount,
            'toBe'=>$artistsToBe
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = $this->artistRepository->getArtistWithRelatedData($id);
        $trendingTracks = $this->trackRepository->getArtistTrendingTracks($id);
        return view("artists.show", [
            'artist'=>$artist,
            'trendingTracks'=>$trendingTracks
        ]);
    }
}
