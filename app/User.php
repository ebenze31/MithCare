<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','username','provider_id','nickname','full_name','avatar','photo','role','phone','birthday'
        ,'gender','province','district','sub_district','address','lat','lng','health_card_1','health_card_2','health_card_3','organization'
        ,'sub_organization','status','ip_address','add_line',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rooms(){
        return $this->hasMany('App\Models\Room','owner_id','id');
    }

    public function appoints(){
        return $this->hasMany('App\Models\Appoint','user_id','id');
    }
    public function member_of_rooms(){
        return $this->hasMany('App\Models\Member_of_room','user_id','id');
    }
    public function ask_for_helps(){
        return $this->hasMany('App\Models\Ask_for_help','user_id','id');
    }



}

