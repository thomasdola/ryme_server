<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * @var string
     */
    protected $table = 'photos';

    /**
     * @var array
     */
    protected $fillable = ['path'];
}
