<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VouchResponse extends Model
{
    /**
     * @var string
     */
    protected $table = 'vouch_responses';

    /**
     * @var array
     */
    protected $fillable = ['vouch_id', 'user_id', 'text'];
}
