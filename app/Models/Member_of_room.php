<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member_of_room extends Model
{

    protected $table = 'member_of_rooms';


    protected $primaryKey = 'id';


    protected $fillable = ['status', 'lv_of_caretaker', 'user_id', 'room_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room','room_id','id');
    }

}
