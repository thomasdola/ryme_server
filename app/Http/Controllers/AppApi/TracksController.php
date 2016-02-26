<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:47 PM
 */

namespace App\Http\Controllers\AppApi;


use App\Jobs\CommentTrack;
use App\Jobs\DislikeTrack;
use App\Jobs\DownloadTrack;
use App\Jobs\LikeTrack;
use App\Jobs\StreamTrack;
use Dingo\Api\Http\Request;
use Eureka\Repositories\TrackRepository;

class TracksController extends PublicApiController
{
    /**
     * @var TrackRepository
     */
    private $repository;

    public function __construct(TrackRepository $repository){
        $this->repository = $repository;
    }

    public function lists(Request $request)
    {
        //['new', 'trending']
        $filter = $request->get('filter');
        if( ! $request->has('scope') ){
            //return tracks within the user followed categories
        }
        //return filtered tracks regardless of the categories the user is following
    }

    public function show($trackId)
    {
        $track = $this->repository->getTrackWithRelations($trackId);
        //Transform and return
    }

    public function stream($trackId)
    {
        $track = $this->repository->getTrack($trackId);
        $this->dispatch(new StreamTrack($track));
    }

    public function like($trackId)
    {
        $track = $this->repository->getTrack($trackId);
        $this->dispatch(new LikeTrack($track));
    }
    public function dislike($trackId)
    {
        $track = $this->repository->getTrack($trackId);
        $this->dispatch(new DislikeTrack($track));
    }

    public function download($trackId)
    {
        $track = $this->repository->getTrack($trackId);
        $this->dispatch(new DownloadTrack($track));
    }

    public function comment($trackId, Request $request)
    {
        $track = $this->repository->getTrack($trackId);
        $commentBody = $request->get('body');
        $this->dispatch(new CommentTrack($track, $commentBody));
    }

    public function artistTracks($artistId, Request $request)
    {
        $type = $request->get('type');
        $tracks = [];
        //Could be either trending or all
        if( $type == 'all' ){
            $tracks = $this->repository->getAllTracksByArtist($artistId);
        }
        $tracks = $this->repository->getTrendingTracksByArtist($artistId);
        //Transform and return
        return $tracks;
    }
}