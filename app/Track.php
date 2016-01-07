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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function downloads()
    {
        return $this->belongsToMany(User::class, 'downloads');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function streams()
    {
        return $this->morphMany(Stream::class, 'streamable');
    }

    public function channel()
    {
        return $this->morphOne(NotificationChannel::class, 'channelable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
