<?php
namespace App\Http\Controllers\InternalApi;

use Eureka\Helpers\Transformers\ArtistTransformer;
use Eureka\Repositories\ArtistRepository;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

/**
 * Class ArtistApiController
 * @package App\Http\Controllers\InternalApi
 */
class ArtistApiController extends InternalApiController
{
    /**
     *
     */
    const RESOURCE_KEY = 'artists';
    /**
     * @var ArtistRepository
     */
    private $artistRepository;
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @param ArtistRepository $artistRepository
     * @param Manager $fractal
     */
    public function __construct(ArtistRepository $artistRepository, Manager $fractal){
        $this->artistRepository = $artistRepository;
        $this->fractal = $fractal->setSerializer(new JsonApiSerializer(self::BASE_URL));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $artists = $this->artistRepository->getAllArtists();
        $data = $this->fractal->createData(new Collection($artists,
            new ArtistTransformer(), self::RESOURCE_KEY))->toArray();
        return response()->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function single($id)
    {
        $artist = $this->artistRepository->getArtist($id);
        if( ! $artist ){
            return response()->json(
                [
                    'status' => 300,
                    'text' => 'not resource found'
                ]
            );
        }
        $data = $this->fractal->createData(new Item($artist,
            new ArtistTransformer(), self::RESOURCE_KEY))->toArray();
        return response()->json($data);
    }

    /**
     * @param $id
     * @return array
     */
    public function getTrendingArtistsByCategory($id)
    {
        return $this->fractal->createData(
            new Collection($this->artistRepository->getTrendingArtistsByCategory($id),
                new ArtistTransformer, 'artists'))->toArray();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexPageData()
    {
        $artistsJoinedToday = $this->artistRepository->getArtistJoinedTodayCount();
        $artistsJoinedThisWeek = $this->artistRepository->getArtistsJoinedThisWeekCount();
        $artistsJoinedThisMonth = $this->artistRepository->getArtistsJoinedThisMonthCount();
        $allArtistsCount = $this->artistRepository->getAllArtistsCount();
        $artistsToBe = $this->artistRepository->getArtistToBe();
        $trendingArtists = $this->fractal->createData(
            new Collection($this->artistRepository->getTrendingArtists(),
                new ArtistTransformer, self::RESOURCE_KEY))->toArray();
        return response()->json([
            'joinedToday'=>$artistsJoinedToday,
            'joinedThisWeek'=>$artistsJoinedThisWeek,
            'joinedThisMonth'=>$artistsJoinedThisMonth,
            'all'=>$allArtistsCount,
            'requests'=>$artistsToBe,
            'trendingArtists' => $trendingArtists
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->search_query;
        return response()->json(['query'=>$query]);
    }
}