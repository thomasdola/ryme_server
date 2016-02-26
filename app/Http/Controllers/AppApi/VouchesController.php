<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:49 PM
 */

namespace App\Http\Controllers\AppApi;


use App\Jobs\AnswerVouch;
use App\Jobs\MakeVouchRequest;
use Dingo\Api\Http\Request;
use Eureka\Repositories\VouchRepository;

/**
 * Class VouchesController
 * @package App\Http\Controllers\AppApi
 */
class VouchesController extends PublicApiController
{
    /**
     * @var VouchRepository
     */
    private $repository;

    /**
     * @param VouchRepository $repository
     */
    public function __construct(VouchRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeRequest(Request $request)
    {
        try{
            $this->dispatch(new MakeVouchRequest($request->all()));
        }catch (\Exception $e){
            return response()->json(['error'=>'not allowed'], 401);
        }
    }

    public function answer($vouchId, Request $request)
    {
        $vouch = $this->repository->getVouch($vouchId);
        $answer = $request->get('answer');
        $this->dispatch(new AnswerVouch($vouch, $answer));
    }
}