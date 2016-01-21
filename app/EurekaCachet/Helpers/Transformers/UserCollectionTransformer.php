<?php
namespace Eureka\Helpers\Transformers;

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
            'followings' => [
                'categories' => $user->following_categories->count(),
                'artists' => $user->following_artists->count()
            ]
        ];
    }
}