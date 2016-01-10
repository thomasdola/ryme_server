<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['path', 'filable_id', 'filable_type'];

    public function filable()
    {
        return $this->morphTo();
    }
}
