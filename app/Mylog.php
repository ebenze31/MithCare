<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mylog extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
