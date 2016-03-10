<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:48 PM
 */

namespace App\Http\Controllers\AppApi;


use App\Event;
use App\Jobs\ViewEvent;
use Eureka\Helpers\Transformers\Mobile\EventAdCollectionTransformer;
use Eureka\Repositories\EventAdRepository;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class EventsController extends PublicApiController
{
    /**
     * @var EventAdRepository
     */
    private $repository;
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @param EventAdRepository $repository
     * @param Manager $fractal
     */
    public function __construct(EventAdRepository $repository, Manager $fractal){
        $this->repository = $repository;
        $this->fractal = $fractal;
    }

    public function lists()
    {
        $events = Event::all();
//        dd($events);
        $data = $this->fractal->createData(new Collection($events,
            new EventAdCollectionTransformer($this->auth->user())))->toArray();
        return $this->respondForDataMerge("success", 200, "success", $data);
    }

    public function view($eventId)
    {
        $event = $this->repository->getSingle($eventId);
        $this->dispatch(new ViewEvent($event, $this->auth->user()));
    }
}