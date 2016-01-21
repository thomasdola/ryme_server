<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/19/2016
 * Time: 4:41 PM
 */

namespace Eureka\Helpers\Transformers;


use App\Company;
use App\Event;
use App\Photo;
use League\Fractal\TransformerAbstract;

class EventAdItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['company', 'photo'];

    public function transform(Event $event)
    {
        return [
            'id'=>$event->uuid,
            'title'=>$event->title,
            'description'=>$event->description,
            'start_date'=>$event->start_date,
            'end_date'=>$event->end_date,
            'views'=>(int)$event->views->count()
        ];
    }

    public function includeCompany(Event $event)
    {
        $company = $event->company;
        return $this->item($company, function(Company $company){
            return [
                'name'=>$company->name
            ];
        });
    }

    public function includePhoto(Event $event)
    {
        $photo = $event->photos->first();
        return $this->item($photo, function(Photo $photo){
            return [
                'path'=>$photo->path
            ];
        });
    }
}