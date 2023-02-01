<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $table = 'rooms';

    protected $primaryKey = 'id';


    protected $fillable = ['name', 'pass' ,'owner_id','home_pic','gen_id'];


    public function user(){
        return $this->belongsTo('App\User','owner_id','id');
    }

    public function member_of_rooms(){
        return $this->hasMany('App\Models\Member_of_room','room_id','id');
    }

}
