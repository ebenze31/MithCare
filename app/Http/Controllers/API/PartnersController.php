<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailToPartner_area;
use App\Models\LineMessagingAPI;
use App\Http\Controllers\API\API_Time_zone;
use App\Models\Mylog;
use App\Models\Check_in;
use App\Models\Partner;
use App\Models\Partner_premium;
use App\Models\Partner_condo;
use App\Models\Group_line;
use App\Models\Time_zone;
use App\Models\Disease;

class PartnersController extends Controller
{
    function submit_show_homepage($partner_id , $input_show_homepage)
    {
        DB::table('partners')
            ->where('id', $partner_id)
              ->update([
                'show_homepage' => $input_show_homepage,
        ]);

        return "OK" ;
    }


}
