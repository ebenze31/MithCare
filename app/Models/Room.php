<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
   
    protected $table = 'rooms';

    protected $primaryKey = 'id';

   
    protected $fillable = ['name', 'pass' ,'owner_id','home_pic'];

    
    public function user(){
        return $this->belongsTo('App\User','owner_id','id');
    }
    
}
