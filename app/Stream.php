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
    protected $fillable = ['track_id', 'user_id', 'streamable_id', 'streamable_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function streamable()
    {
        return $this->morphTo();
    }
}
