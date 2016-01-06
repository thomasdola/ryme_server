<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * @var string
     */
    protected $table = 'staff';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'uuid', 'password', ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
