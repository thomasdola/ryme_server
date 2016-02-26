<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/23/2016
 * Time: 6:41 PM
 */

namespace App\Http\Controllers\AppApi;


use App\Jobs\FollowGenre;
use App\Jobs\followManyGenres;
use App\Jobs\UnfollowGenre;
use App\User;
use Dingo\Api\Http\Request;
use Eureka\Helpers\Transformers\CategoriesTransformer;
use Eureka\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class CategoriesController extends PublicApiController
{

    protected $user;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @param CategoryRepository $categoryRepository
     * @param Manager $fractal
     */
    public function __construct(CategoryRepository $categoryRepository, Manager $fractal)
    {
        $this->user = $this->auth()->user();
        $this->categoryRepository = $categoryRepository;
        $this->fractal = $fractal->setSerializer(new ArraySerializer());
    }
    public function lists()
    {
        $categories = $this->categoryRepository->getAll()->toArray();
//        $categories = $this->fractal->createData(new Collection($categories, new CategoriesTransformer))
//            ->toArray();
        return $this->response->array($categories)->setStatusCode(200);
    }

    public function follow($genreId)
    {
        $genre = $this->categoryRepository->getCategory($genreId);
        try{
            $this->dispatch(new FollowGenre($genre, $this->user));
        }catch (\Exception $e){
            throw $e;
//            return $this->respondForAction("error", $e->getCode());
        }
        return $this->respondForAction("success", 200, "category followed successfully");
    }

    public function unFollow($genreId, Request $request)
    {
        $genre = $this->categoryRepository->getCategory($genreId);
        try{
            $this->dispatch(new UnfollowGenre($genre, $this->user));
        }catch (\Exception $e){
            throw $e;
//            return $this->respondForAction("error", $e->getCode());
        }
        return $this->respondForAction("success", 200, "category unfollowed successfully");
    }

    public function bulkFollow(Request $request)
    {
        $this->dispatch(new followManyGenres($request->get('categoryIds')));
    }
}