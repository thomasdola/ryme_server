<?php

namespace App;

use App\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Event extends Model
{
    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'time', 'date', 'started_on', 'ending_on', 'is_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'imageable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
