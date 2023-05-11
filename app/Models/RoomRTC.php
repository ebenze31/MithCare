<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRTC extends Model
{

    protected $table = 'room_rtc';

    protected $primaryKey = 'id';


    protected $fillable = ['room_id', 'room_name' ,'time_start','current_people','total_timemeet','amount_meet','room_of_members'];


    public function user(){
        return $this->belongsTo('App\User','owner_id','id');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room','room_id','id');
    }

}
