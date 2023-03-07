<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partners';

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
    protected $fillable = ['name', 'full_name', 'type', 'phone', 'mail', 'name_line_group', 'show_homepage', 'line_group_id','logo'];




}
