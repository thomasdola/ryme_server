<?php

namespace App\Http\Controllers\InternalApi;


use Eureka\Helpers\Transformers\UserCollectionTransformer;
use Eureka\Helpers\Transformers\UserTransformer;
use Eureka\Repositories\UserRepository;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class UsersApiController extends InternalApiController
{
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Manager $fractal, UserRepository $userRepository){
        $this->fractal = $fractal->setSerializer(new JsonApiSerializer(self::BASE_URL));
        $this->userRepository = $userRepository;
    }

    public function all(Request $request)
    {
        $users = collect([]);
        if( ! $request->type ){
            $users = $this->userRepository->getAllUsers();
        }elseif( strtolower(trim($request->type)) == "today"){
            $users = $this->userRepository->getUsersJoinedToday();
        }elseif( strtolower(trim($request->type)) == "week"){
            $users = $this->userRepository->getUsersJoinedThisWeek();
        }elseif( strtolower(trim($request->type)) == "month"){
            $users = $this->userRepository->getUsersJoinedThisMonth();
        }

        if( $users->isEmpty() ){
            return response()->json(['query'=>$request->type, 'status'=>300, 'text'=>'not found']);
        }
        $data = $this->fractal->createData(new Collection($users,
            new UserCollectionTransformer, 'users'))->toArray();
        return response()->json(['query'=>$request->type, 'data'=>$data]);
    }

    public function single(){}

    public function update(){}

    public function delete(){}

    public function indexPageData()
    {
        $todayCount = $this->userRepository->getUsersJoinedTodayCount();
        $thisWeekCount = $this->userRepository->getUsersJoinedThisWeekCount();
        $thisMonthCount = $this->userRepository->getUsersJoinedThisMonthCount();
        $allCount = $this->userRepository->getAllUsersCount();
        return response()->json([
            'todayCount'=>$todayCount,
            'thisWeekCount'=>$thisWeekCount,
            'thisMonthCount'=>$thisMonthCount,
            'allCount'=>$allCount
        ]);
    }
}