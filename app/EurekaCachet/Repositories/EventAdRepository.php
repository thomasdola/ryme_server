<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/19/2016
 * Time: 3:14 PM
 */

namespace Eureka\Repositories;


use App\Event;

class EventAdRepository
{
    /**
     * @var Event
     */
    private $event;

    public function __construct(Event $event){
        $this->event = $event;
    }

    public function getAll()
    {
        $events = $this->event->all();
        return $events;
    }

    public function getSingle($id)
    {
        $event = $this->event->where('uuid', $id)->first();
        return $event;
    }

    public function update($id, $data)
    {
        $event = $this->getSingle($id);
        $event = $event->fill($data);
        $event->save();
        return $event;
    }

    public function addEvent($data)
    {
        $event = $this->event->fill($data);
        $event->save();
        return $event;
    }

    public function delete($id)
    {
        $event = $this->getSingle($id);
        $event->delete();
        return $event;
    }

    public function getAds()
    {
        $activeAds = $this->event->where('is_active', true)->get();
        return collect($activeAds);
    }
}