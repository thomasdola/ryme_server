<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 3/9/2016
 * Time: 6:45 PM
 */

namespace Eureka\Helpers\Transformers\Mobile;


use App\Event;
use App\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class EventAdCollectionTransformer extends TransformerAbstract
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    public function transform(Event $event)
    {
        return [
            'title'=>$event->title,
            'date'=>Carbon::parse($event->date_time)->timestamp * 1000,
            'time'=>Carbon::parse($event->date_time)->timestamp * 1000,
            'description' => $event->description,
            'fare'=>$event->fare,
            'views'=>$event->views->count(),
            'uuid'=>$event->uuid,
            'venue'=>$event->venue,
            'cover'=>$event->photo->path
        ];
    }
}