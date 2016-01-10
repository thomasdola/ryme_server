<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouch extends Model
{
    /**
     * @var string
     */
    protected $table = 'vouches';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'start_date', 'end_date', 'is_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vouch_responses()
    {
        return $this->belongsToMany(VouchResponse::class, 'vouch_responses', 'vouch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->morphOne(NotificationChannel::class, 'channelable');
    }
}
