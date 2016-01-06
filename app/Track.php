<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    /**
     * @var string
     */
    protected $table = 'tracks';

    /**
     * @var array
     */
    protected $fillable = ['uuid', 'title', 'duration', 'release_date', 'user_id', 'slug'];
}
