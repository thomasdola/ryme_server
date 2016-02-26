<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 2/23/2016
 * Time: 8:21 PM
 */

namespace Eureka\Helpers\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserItemTransformer extends TransformerAbstract
{
    public function transform(User $user){
        return [
            "uuid" => $user->uuid,
            "username" => $user->username,
            "avatar" => $user->photos->first() ? $user->photos->first()->path : null,
            "is_artist" => (boolean)$user->is_artist,
            "phone_number" => $user->phone,
            "background_picture" => $user->photos->last() ? $user->photos->last()->path : null
        ];
    }
}