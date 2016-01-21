<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/18/2016
 * Time: 7:06 AM
 */

namespace Eureka\Helpers\Transformers;

use App\User;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
class ArtistItemTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->uuid,
            'email' => $user->email,
            'name' => $user->stage_name,
            'username' => $user->username,
            'category' => [
                'name' => $user->category->name,
                'id' => (int)$user->category->id
            ],
            'followers' => (int)$user->followers->count(),
            'tracks' => (int)$user->tracks->count(),
            'photos' => ''
        ];
    }
}