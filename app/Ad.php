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
    protected $fillable = ['title', 'uuid', 'start_date', 'end_date', 'is_active', 'company_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function streams()
    {
        return $this->morphMany(Stream::class, 'streamable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function files()
    {
       return $this->morphMany(File::class, 'filable');
    }
}
