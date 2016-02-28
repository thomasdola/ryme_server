<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:49 PM
 */

namespace App\Http\Controllers\AppApi;


use App\File;
use App\Jobs\UpdateBackPicture;
use App\Jobs\UpdateProfileInfo;
use App\Jobs\UpdateProfilePicture;
use Dingo\Api\Http\Request;
use Eureka\Repositories\UserRepository;
use Eureka\Services\Interfaces\VouchServiceInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
//        dd($request->all());
        $job = new UpdateProfileInfo($request->all(), $this->auth->user());
        try{
            $this->dispatch($job);
            return $this->respondForAction("success", 200, "information updated successfully.");
        }catch (\Exception $e){
            return $this->respondForAction("error", $e->getCode(), $e->getMessage());
        }
    }

    public function isAllowedToBeArtist(VouchServiceInterface $vouchService){

        $isHe = $vouchService->isAllowed($this->auth->user());
        if(!$isHe){
            return $this->respondForAction("error", 401, "Not Allowed");
        }
        return $this->respondForAction("success", 200, "Allowed");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws FileException
     * @throws \Exception
     */
    public function photo(Request $request){
        $user = $this->auth->user();
        $file = $request->file;
        if($file->isValid()){
            if(strtolower($request->type) == "avatar"){
                return $this->launchAvatarSaver($file, $user);
            }elseif(strtolower($request->type) == "background"){
                return $this->launchBackImageSaver($file, $user);
            }
        }else{
            return $this->respondForAction("error", 404, "file not found");
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

    /**
     * @param $file
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function launchAvatarSaver($file, $user)
    {
        $destinationPath = base_path().'/public/users/profile/images/';
        $ext = $file->getClientOriginalExtension();
        $fileName = $user->username . '_avatar_' . '.' . $ext;
        $full_path = '/users/profile/images/' . $fileName;
        try{
            $newFile = $file->move($destinationPath, $fileName);
//            dd($newFile);
        }catch (FileException $e){
            throw $e;
        }
        $job = new UpdateProfilePicture($full_path, $user);
        try {
            $this->dispatch($job);
            return $this->respondForAction("error", 200, "image saved successfully.");
        } catch (\Exception $e) {
//            return $this->respondForAction("error", $e->getCode());
            throw $e;
        }
    }

    /**
     * @param $file
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    private function launchBackImageSaver($file, $user)
    {
        $job = new UpdateBackPicture($file, $user);
        try{
            $this->dispatch($job);
            return $this->respondForAction("error", 200, "image saved successfully.");
        } catch (\Exception $e) {
            return $this->respondForAction("error", $e->getCode(), $e->getMessage());
        }
    }
}