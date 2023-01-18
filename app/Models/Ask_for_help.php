<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ask_for_help extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ask_for_helps';

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
    protected $fillable = ['name_user', 'lat', 'lng', 'province', 'district', 'sub_district', 'address', 'content', 'photo_sos', 'organization_helper', 'name_helper', 'help_complete', 'help_complete_time', 'score_impression', 'score_period', 'score total', 'commemt_help', 'notify', 'photo_succeed', 'photo_succeed_by', 'remark_helper', 'time_go_to_help', 'helper_id', 'user_id', 'partner_id'];

    
}
