<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Health_check extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'health_checks';

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
    protected $fillable = ['title', 'img_1', 'img_2', 'img_3', 'user_id'];

    
}
