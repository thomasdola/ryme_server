<?php

namespace Eureka\Services\Interfaces;
use App\User;


/**
 * Interface VouchServiceInterface
 * @package Eureka\Services\Interfaces
 */
interface VouchServiceInterface
{
    /**
     * Make a vouch request
     *
     * @return mixed
     */
    public function makeRequest();
}