<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/9/2016
 * Time: 4:41 PM
 */

namespace Eureka\Repositories;


use App\Category;

class CategoryRepository
{

    /**
     * @var Category
     */
    private $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category){
        $this->category = $category;
    }

    /**
     *
     */
    public function getTrendingCategories()
    {

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->category
//            ->with('artists', 'followers', 'tracks')
            ->all();
    }

    /**
     * @param $id
     * @return static
     */
    public function getCategory($id)
    {
        return $this->category->with('artists', 'tracks', 'followers')->where('uuid', $id)->first();
    }

    /**
     * @param $data
     * @return static
     */
    public function addCategory($data)
    {
        return $this->category->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return CategoryRepository
     */
    public function updateCategory($id, $data)
    {
        $data = collect($data);
        $category = $this->getCategory($id);
        $category->name = $data->get('name');
        $category->save();
        return $category;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCategory($id)
    {
        $category = $this->getCategory($id);
        $category->delete();
        return $category;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTrendingArtistsByCategory($id)
    {
       return $this->category->with('artists')
           ->where('uuid', $id)->artists
           ->sortDescBy(function($artist){
               return $artist->followers->count();
           });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryTrendingTracks($id)
    {
       return $this->category->with('tracks')
           ->where('uuid', $id)
           ->tracks
           ->sortDescBy(function($track){
               $track->streams->count();
           });
    }
}