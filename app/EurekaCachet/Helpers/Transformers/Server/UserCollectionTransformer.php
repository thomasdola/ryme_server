<?php
namespace Eureka\Helpers\Transformers\Server;

use App\User;
use League\Fractal\TransformerAbstract;

class UserCollectionTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->uuid,
            'username' => $user->username,
            'country' => $user->country,
            'phone' => $user->phone,
            'categories' => $user->following_categories->count(),
            'artists' => $user->following_artists->count()
        ];
    }
}