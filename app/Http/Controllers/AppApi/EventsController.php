<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:48 PM
 */

namespace App\Http\Controllers\AppApi;


use App\Jobs\ViewEvent;
use Dingo\Api\Http\Request;
use Eureka\Repositories\EventAdRepository;

class EventsController extends PublicApiController
{
    /**
     * @var EventAdRepository
     */
    private $repository;

    public function __construct(EventAdRepository $repository){
        $this->repository = $repository;
    }

    public function lists()
    {
        $events = $this->repository->getAds();
        //transform and return
    }

    public function view($eventId)
    {
        $event = $this->repository->getSingle($eventId);
        $this->dispatch(new ViewEvent($event));
    }
}