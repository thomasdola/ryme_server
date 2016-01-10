<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use Eureka\Repositories\StaffRepository;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    /**
     * @var StaffRepository
     */
    private $staffRepository;
    /**
     * @var Role
     */
    private $role;

    public function __construct(StaffRepository $staffRepository, Role $role){
        $this->staffRepository = $staffRepository;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allStaff = $this->staffRepository->getAllStaffs();
        $allRolesWithStaff = $this->role->with('staff')->get();
        return response()->json(['roles'=>$allRolesWithStaff, 'staff'=>$allStaff]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->staffRepository->addStaff($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->staffRepository->editStaff($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->staffRepository->deleteStaff($id);
    }
}
