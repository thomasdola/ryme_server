<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/18/2016
 * Time: 7:06 AM
 */

namespace Eureka\Helpers\Transformers\Server;

use App\User;
use League\Fractal\TransformerAbstract;

class ArtistCollectionTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->uuid,
            'name' => $user->stage_name,
            'photos' => ''
        ];
    }
}