<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/9/2016
 * Time: 6:39 PM
 */

namespace Eureka\Repositories;


use App\Vouch;
use App\VouchResponse;

class VouchRepository
{

    /**
     * @var Vouch
     */
    private $vouch;
    /**
     * @var VouchResponse
     */
    private $vouchResponse;

    public function __construct(Vouch $vouch, VouchResponse $vouchResponse){
        $this->vouch = $vouch;
        $this->vouchResponse = $vouchResponse;
    }

    public function getRecentRequests()
    {
        return $this->vouch->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}