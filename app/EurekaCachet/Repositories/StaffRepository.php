<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/10/2016
 * Time: 12:11 PM
 */

namespace Eureka\Repositories;


use App\User;
use Webpatser\Uuid\Uuid;

class StaffRepository
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function getAllStaffs()
    {
        return $this->user->all();
    }

    public function addStaff($data)
    {
        $uuid = Uuid::generate(4);
        $payload = array_add($data, 'uuid', $uuid);
        $payload = array_add($payload, 'password', bcrypt($data['name']));
        return $this->user->create($payload);
    }

    public function editStaff($data, $id)
    {
        $staff = $this->user->find($id);
        $editedStaff = $staff->fill($data);
        $editedStaff->save();
        return $editedStaff;
    }

    public function deleteStaff($id)
    {
        $staff = $this->user->find($id);
        $staff->delete();
        return $staff;
    }

}