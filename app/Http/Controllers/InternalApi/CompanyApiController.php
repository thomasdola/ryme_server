<?php

namespace App\Http\Controllers\InternalApi;


use Eureka\Repositories\CompaniesRepository;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class CompanyApiController extends InternalApiController
{
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var CompaniesRepository
     */
    private $companiesRepository;

    public function __construct(Manager $fractal, CompaniesRepository $companiesRepository){
        $this->fractal = $fractal;
        $this->companiesRepository = $companiesRepository;
    }

    public function all()
    {
        $companies = $this->companiesRepository->getAll();
    }

    public function single($id)
    {
        $company = $this->companiesRepository->getSingle($id);
    }

    public function update($id, Request $request)
    {
        $company = $this->companiesRepository->update($id, $request->all());
    }

    public function store(Request $request)
    {
        $company = $this->companiesRepository->addCompany($request->all());
    }

    public function delete($id)
    {
        $company = $this->companiesRepository->delete($id);
    }
}