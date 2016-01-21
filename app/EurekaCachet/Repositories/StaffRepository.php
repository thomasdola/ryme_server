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
//        return $this->user->with('role')->where('type', 'staff')->get()->toArray();
        return $this->user->all()->take(3);
    }

    public function addStaff($data)
    {
        $uuid = Uuid::generate(4);
        $payload = array_add($data, 'uuid', $uuid);
        $payload = array_add($payload, 'type', 'staff');
        $payload = array_add($payload, 'password', bcrypt($data['name']));
        return $this->user->create($payload);
    }

    public function editStaff($data, $id)
    {
        $staff = $this->getStaffByUuid($id);
        $editedStaff = $staff->fill($data);
        $editedStaff->save();
        return $editedStaff;
    }

    public function deleteStaff($id)
    {
        $staff = $this->getStaffByUuid($id);
        $staff->delete();
        return $staff;
    }

    public function getStaffByUuid($id)
    {
        return $this->user->with('role')
            ->where(['uuid'=>$id, 'type'=>'staff'])
            ->firstOrFail();
    }

}