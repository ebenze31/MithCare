<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambon extends Model
{
    
  
    protected $fillable = [
        'tambon', 'amphoe', 'province','zipcode','tambon_code','tambon_code','amphoe_code','province_code',
    ];

 
    protected $hidden = [
        'password', 'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
