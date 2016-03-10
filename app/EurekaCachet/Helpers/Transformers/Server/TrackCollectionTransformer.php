<?php
namespace Eureka\Helpers\Transformers\Server;

use App\Category;
use App\Track;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
class TrackCollectionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['genre'];

    public function transform(Track $track)
    {
        return [
            'title' => $track->title,
            'id' => $track->uuid,
            'released_date' => [
                'year' => Carbon::parse($track->released_date)->year,
                'month' => Carbon::parse($track->released_date)->month,
                'day' => Carbon::parse($track->released_date)->day
            ],
        ];
    }

    public function includeGenre(Track $track)
    {
        $category = $track->category;
        return $this->item($category, function(Category $category){
            return [
                'name'=>$category->name,
                'id'=>$category->uuid
            ];
        }, 'categories');
    }

    public function includeArtist(Track $track)
    {
        $artist = $track->artist;
        return $this->item($artist, function(User $artist){
            return [
                'stage_name'=>$artist->stage_name,
                'id'=>$artist->uuid
            ];
        }, 'artists');
    }
}