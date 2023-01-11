<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appoint extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appoints';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'type', 'date_time', 'status', 'sent_round', 'user_id'];

    
}
