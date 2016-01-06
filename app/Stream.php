<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    /**
     * @var string
     */
    protected $table = 'streams';

    /**
     * @var array
     */
    protected $fillable = ['track_id', 'user_id'];
}
