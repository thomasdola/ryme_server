<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/19/2016
 * Time: 3:14 PM
 */

namespace Eureka\Repositories;


use App\Event;
use App\User;

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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param Event $event
     * @param UserRepository $userRepository
     */
    public function __construct(Event $event, UserRepository $userRepository){
        $this->event = $event;
        $this->userRepository = $userRepository;
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
     * @return static
     */
    public function addEvent($data)
    {
        $event = $this->event->create($data);
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
        $activeAds = $this->event->where('is_active', '1')->get();
        return $activeAds;
    }

    public function getAdsScopedTo(User $user)
    {
        $categories = $this->userRepository->followedCategories($user);
    }
}