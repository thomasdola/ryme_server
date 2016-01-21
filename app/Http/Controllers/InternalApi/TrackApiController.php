<?php
namespace App\Http\Controllers\InternalApi;

use Eureka\Helpers\Transformers\TrackTransformer;
use Eureka\Repositories\TrackRepository;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class TrackApiController extends InternalApiController
{
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var TrackRepository
     */
    private $trackRepository;

    public function __construct(Manager $fractal, TrackRepository $trackRepository){
        $this->fractal = $fractal->setSerializer(new JsonApiSerializer(self::BASE_URL));
        $this->trackRepository = $trackRepository;
    }

    public function getTrendingTrackByCategory($id)
    {
        return $this->fractal->createData(
            new Collection($this->trackRepository->getTrendingTracksByCategory($id),
                new TrackTransformer, 'tracks'))->toArray();
    }

    public function getTrendingTracksByArtist($id)
    {
        return $this->trackRepository->getTrendingTracksByArtist($id);
    }
}