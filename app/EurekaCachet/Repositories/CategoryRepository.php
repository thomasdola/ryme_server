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

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function getTrendingCategories()
    {

    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function getCategory($id)
    {
        return $this->category->find($id);
    }

    public function addCategory($data)
    {
        return $this->category->create($data);
    }

    public function updateCategory($id, $data)
    {
        $data = collect($data);
        $category = $this->category->find($id);
        $category->name = $data->get('name');
        $category->save();
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = $this->category->find($id);
        $category->delete();
        return $category;
    }

    public function getCategoryTrendingArtists($id)
    {
       return $this->category->find($id)
           ->artists
           ->sortDescBy(function($artist){
               return $artist->followers->count();
           });
    }

    public function getCategoryTrendingTracks($id)
    {
       return $this->category->find($id)
           ->tracks
           ->sortDescBy(function($track){
               $track->streams->count();
           });
    }
}