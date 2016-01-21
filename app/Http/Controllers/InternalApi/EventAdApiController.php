<?php

namespace App\Http\Controllers\InternalApi;


use Eureka\Helpers\Transformers\EventAdItemTransformer;
use Eureka\Repositories\EventAdRepository;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

class EventAdApiController extends InternalApiController
{
    const RESOURCE_KEY = 'events';
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var EventAdRepository
     */
    private $eventAdRepository;

    public function __construct(Manager $fractal, EventAdRepository $eventAdRepository){
        $this->fractal = $fractal->setSerializer(new JsonApiSerializer(self::BASE_URL));
        $this->eventAdRepository = $eventAdRepository;
    }
    
    public function all()
    {
        $ads = $this->eventAdRepository->getAll();
        $data = $this->fractal->createData(new Collection($ads,
            new EventAdItemTransformer, self::RESOURCE_KEY))->toArray();
        return response()->json($data);
    }

    public function single($id)
    {
        $ad = $this->eventAdRepository->getSingle($id);
        return $this->returnResponse($ad);
    }

    public function update($id, $data)
    {
        $ad = $this->eventAdRepository->update($id, $data);
        return $this->returnResponse($ad);
    }

    public function store($data)
    {
        $ad = $this->eventAdRepository->addEvent($data);
        return $this->returnResponse($ad);
    }

    /**
     * @param $ad
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnResponse($ad)
    {
        $data = $this->fractal->createData(new Item($ad,
            new EventAdItemTransformer, self::RESOURCE_KEY))->toArray();
        return response()->json($data);
    }
}