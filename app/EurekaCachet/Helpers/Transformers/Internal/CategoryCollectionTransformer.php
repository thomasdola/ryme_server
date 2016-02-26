<?php
namespace Eureka\Helpers\Transformers;


use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryCollectionTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'name'=> $category->name,
            'id'=> $category->uuid,
            'artists' => $category->artists->count(),
            'followers' => $category->followers->count(),
            'tracks' => $category->tracks->count()
        ];
    }
}