<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member_of_room extends Model
{
   
    protected $table = 'member_of_rooms';

  
    protected $primaryKey = 'id';

  
    protected $fillable = ['status', 'lv_of_caretaker', 'user_id', 'room_id'];

    public function member_of_room(){
        return $this->belongsTo('App\Models\Member_of_room','user_id','id');
    }
}
