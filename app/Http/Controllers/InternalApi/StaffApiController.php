<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/19/2016
 * Time: 5:13 PM
 */

namespace App\Http\Controllers\InternalApi;


use Eureka\Repositories\StaffRepository;
use League\Fractal\Manager;

class StaffApiController extends InternalApiController
{
    /**
     * @var StaffRepository
     */
    private $staffRepository;
    /**
     * @var Manager
     */
    private $fractal;

    public function __construct(StaffRepository $staffRepository, Manager $fractal){
        $this->staffRepository = $staffRepository;
        $this->fractal = $fractal;
    }

    public function all(){}

    public function single($id){}

    public function update($id, $data){}

    public function store($data){}

    public function delete($id){}
}