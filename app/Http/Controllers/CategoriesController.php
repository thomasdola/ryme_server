<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Eureka\Repositories\ArtistRepository;
use Eureka\Repositories\CategoryRepository;
use Eureka\Repositories\TrackRepository;
use Illuminate\Http\Request;

/**
 * Class CategoriesController
 * @package App\Http\Controllers
 */
class CategoriesController extends Controller
{
    /**
     * @var ArtistRepository
     */
    private $artistRepository;
    /**
     * @var TrackRepository
     */
    private $trackRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     * @param ArtistRepository $artistRepository
     * @param TrackRepository $trackRepository
     * @internal param Category $category
     */
    public function __construct(CategoryRepository $categoryRepository,
                                ArtistRepository $artistRepository,
                                TrackRepository $trackRepository){
        $this->artistRepository = $artistRepository;
        $this->trackRepository = $trackRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('categories.index')->withCategories($categories);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * @param $id
     */
    public function getCategory($id)
    {
        $category = $this->categoryRepository->getCategory($id);
        $trendingArtists = $this->categoryRepository->getCategoryTrendingArtists($category->id);
        $trendingTracks = $this->categoryRepository->getCategoryTrendingTracks($category->id);
        return response()->json([
            'category'=>$category,
            'trendingTracks'=>$trendingTracks,
            'trendingArtists'=>$trendingArtists
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->categoryRepository->addCategory($request->all());
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
        return $this->categoryRepository->updateCategory($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedCategory = $this->categoryRepository->deleteCategory($id);
        return response()->json($deletedCategory);
    }
}
