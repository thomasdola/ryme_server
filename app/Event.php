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
    protected $fillable = ['title', 'uuid', 'description', 'time', 'date', 'start_date', 'end_date', 'is_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
