<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:48 PM
 */

namespace App\Http\Controllers\AppApi;


use App\Jobs\FollowArtist;
use App\Jobs\UnfollowArtist;
use Eureka\Repositories\ArtistRepository;

class ArtistsController extends PublicApiController
{
    /**
     * @var ArtistRepository
     */
    private $repository;

    public function __construct(ArtistRepository $repository){
        $this->repository = $repository;
    }

    public function show($artistId)
    {
        $artist = $this->repository->getArtistWithRelations($artistId);
        //transform and return
    }

    public function follow($artistId)
    {
        $artist = $this->repository->getArtist($artistId);
        $this->dispatch(new FollowArtist($artist));
    }

    public function unFollow($artistId)
    {
        $artist = $this->repository->getArtist($artistId);
        $this->dispatch(new UnfollowArtist($artist));
    }


}