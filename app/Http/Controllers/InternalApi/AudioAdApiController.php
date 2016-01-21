<?php

namespace App\Http\Controllers\InternalApi;


use Eureka\Helpers\Transformers\AudioAdCollectionTransformer;
use Eureka\Helpers\Transformers\AudioAdItemTransformer;
use Eureka\Repositories\AudioAdRepository;
use Eureka\Repositories\CompaniesRepository;
use Eureka\Repositories\EventAdRepository;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;

class AudioAdApiController extends InternalApiController
{
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var AudioAdRepository
     */
    private $audioAdRepository;
    /**
     * @var EventAdRepository
     */
    private $eventAdRepository;
    /**
     * @var CompaniesRepository
     */
    private $companiesRepository;

    public function __construct(Manager $fractal, AudioAdRepository $audioAdRepository,
                                EventAdRepository $eventAdRepository, CompaniesRepository $companiesRepository){
        $this->fractal = $fractal->setSerializer(new JsonApiSerializer(self::BASE_URL));
        $this->audioAdRepository = $audioAdRepository;
        $this->eventAdRepository = $eventAdRepository;
        $this->companiesRepository = $companiesRepository;
    }

    public function all()
    {
        $activeAds = $this->audioAdRepository->getAds();
        $data = $this->fractal->createData(new Collection($activeAds,
            new AudioAdCollectionTransformer, 'ads'))->toArray();
        return response()->json($data);
    }

    public function single($id)
    {
        $ad = $this->audioAdRepository->getAd($id);
        $data = $this->fractal->createData(new Item($ad,
            new AudioAdItemTransformer, 'ads'))->toArray();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $ad = $this->audioAdRepository->createAd($request->all());
        $data = $this->fractal->createData(new Item($ad,
            new AudioAdItemTransformer, 'ads'))->toArray();
        return response()->json($data);
    }

    public function update($id, $data)
    {
        $ad = $this->audioAdRepository->editAd($id, $data);
        $data = $this->fractal->createData(new Item($ad,
            new AudioAdItemTransformer, 'ads'))->toArray();
        return response()->json($data);
    }

    public function getIndexPageData()
    {
        $audioActiveCount = $this->audioAdRepository->getAds()->count();
        $eventActiveCount = $this->eventAdRepository->getAds()->count();
        $companiesCount = $this->companiesRepository->getAll()->count();
        return response()->json([
            'activeAudioAdsCount' => $audioActiveCount,
            'activeEventAdsCount' => $eventActiveCount,
            'companiesCount' => $companiesCount
        ]);
    }
}