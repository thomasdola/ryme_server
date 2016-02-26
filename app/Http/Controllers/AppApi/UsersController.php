<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:49 PM
 */

namespace App\Http\Controllers\AppApi;


use Dingo\Api\Http\Request;
use Eureka\Repositories\UserRepository;

class UsersController extends PublicApiController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function favorites(Request $request)
    {
        $type = $request->get('type');
        $favorites = $this->getFavorites($type);
        return $favorites;
    }

    public function update(Request $request)
    {
        $updateUser = $this->repository->update($request->all(), $userId);
        //Transform and return
    }

    public function photo(Request $request){
        $file = $request->get('file');
        if($file){
            return $this->respondForAction("success", 200, "file exists");
        }else{
            return $this->respondForAction("error", 401, "file not found");
        }
    }

    public function upload(Request $request){}

    public function followedCategories(){
        $categories = $this->repository->followedCategories($this->auth->user());
        return $this->response->array($categories)->setStatusCode(200);
    }

    /**
     * @param $type
     * @return mixed
     */
    private function getFavorites($type)
    {
        $user = $this->auth->user();
        $favorites = [];
        if ($type == 'tracks') {
            $favorites = $this->repository->getFavoriteTracksFor($user);
            return $favorites;
        } elseif ($type == 'artists') {
            $favorites = $this->repository->getFavoriteArtistsFor($user);
            return $favorites;
        }
        return $favorites;
    }
}