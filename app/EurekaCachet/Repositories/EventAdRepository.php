<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/19/2016
 * Time: 3:14 PM
 */

namespace Eureka\Repositories;


use App\Event;

/**
 * Class EventAdRepository
 * @package Eureka\Repositories
 */
class EventAdRepository
{
    /**
     * @var Event
     */
    private $event;

    /**
     * @param Event $event
     */
    public function __construct(Event $event){
        $this->event = $event;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        $events = $this->event->all();
        return $events;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSingle($id)
    {
        $event = $this->event->where('uuid', $id)->first();
        return $event;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $event = $this->getSingle($id);
        $event = $event->fill($data);
        $event->save();
        return $event;
    }

    /**
     * @param $data
     * @return $this
     */
    public function addEvent($data)
    {
        $event = $this->event->fill($data);
        $event->save();
        return $event;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $event = $this->getSingle($id);
        $event->delete();
        return $event;
    }

    /**
     * @return mixed
     */
    public function getAds()
    {
        $activeAds = $this->event->where('is_active', true)->get();
        return $activeAds;
    }
}