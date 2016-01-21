<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/18/2016
 * Time: 7:07 AM
 */

namespace Eureka\Helpers\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

/**
 * Class StaffTransformer
 * @package Eureka\Helpers\Transformers
 */
class StaffTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = ['role'];

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Item
     */
    public function includeRole(User $user)
    {
        $role = $user->role;
        return $this->item($role, new RoleCollectionTransformer, 'roles');
    }
}