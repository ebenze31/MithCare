<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appoint extends Model
{
  
    protected $table = 'appoints';

   
    protected $primaryKey = 'id';

   
    protected $fillable = ['title', 'type', 'date_time','date', 'status', 'sent_round', 'patient_id','room_id','create_by_id'];

    public function appoint(){
        return $this->belongsTo('App\Appoint','user_id','id');
    }
}
