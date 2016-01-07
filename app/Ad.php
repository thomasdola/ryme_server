<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    /**
     * @var string
     */
    protected $table = 'ads';

    /**
     * @var array
     */
    protected $fillable = ['title', 'type', 'schedule', 'started_on', 'ending_on', 'is_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function streams()
    {
        return $this->morphMany(Stream::class, 'streamable');
    }
}
