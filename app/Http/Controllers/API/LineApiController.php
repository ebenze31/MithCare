<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ask_for_help;
use Illuminate\Http\Request;
use App\Models\Mylog;
use App\Models\LineMessagingAPI;
use App\Models\Group_line;
use App\Models\Partner;
use App\User;

class LineApiController extends Controller
{
    public function store(Request $request)
    {
        //SAVE LOG
        $requestData = $request->all();
        $data = [
            "title" => "Line",
            "content" => json_encode($requestData, JSON_UNESCAPED_UNICODE),
        ];
        MyLog::create($data);

        //GET ONLY FIRST EVENT
        $event = $requestData["events"][0];

        switch($event["type"]){
            case "message" :
                $this->messageHandler($event);
                break;
            case "postback" :
                $this->postbackHandler($event);
                break;
            case "join" :
                $this->save_group_line($event);
                break;
            case "follow" :
                $this->user_follow_line($event);
                DB::table('users')
                    ->where([
                            ['type', 'line'],
                            ['provider_id', $event['source']['userId']],
                            ['status', "active"]
                        ])
                    ->update(['add_line' => 'Yes']);
                break;
        }
    }

    function messageHandler($event){

        switch($event["message"]["type"]){
            case "text" :
                $this->textHandler($event);
                break;
        }

    }

     public function textHandler($event)
    {
        $line = new LineMessagingAPI();
        $text = $event["message"]["text"] ;

        // $data_users = DB::table('users')
        //         ->where('provider_id', $event["source"]['userId'])
        //         ->where('status', "active")
        //         ->get();

        switch( $text )
        {
            case "ทดสอบ" :
                $line->replyToUser($event, "test");
                break;
            case "สมัครสมาชิก" :
                $line->replyToUser($event, "register");
                break;
            case "โรงพยาบาล/ร้านยา" :
                $line->replyToUser($event, "select_menu_hnd");
                break;
            case "ครอบครัวของฉัน" :
                $line->replyToUser($event, "select_my_room");
                break;
            case "อื่นๆ" :
                $line->replyToUser($event, "select_menu_other");
                break;

        }

    }

    function postbackHandler($event){

        $line = new LineMessagingAPI();

        $data_postback_explode = explode("?",$event["postback"]["data"]);
        $data_postback = $data_postback_explode[0] ;

        $data = [
            "title" => "Line",
            "content" => $data_postback,
        ];
        MyLog::create($data);

        $data = [
            "title" => "Line",
            "content" => "เข้า postback",
        ];
        MyLog::create($data);

        // $data_postback = $event["postback"]["data"] ;

        switch($data_postback){

            case "accept_pill" :
                $line->select_reply( $event, $data_postback , $data_postback_explode[1]);
                break;
            case "accept_doc" :
                $line->select_reply( $event, $data_postback , $data_postback_explode[1]);
                break;
            case "sos" :
                $this->sos_helper($data_postback_explode[1] , $event["source"]["userId"] , $event);
                break;
            case "help_complete" :
                $this->check_help_complete_by_helper($event, $data_postback, $data_postback_explode[1]);
                break;
            // case "accept_pill" :
            //     $line->_pushguestLine(null, $event, "accept_pill");
            //     $line->reply_success($event , $data_postback);
            //     break;
            // case "wait" :
            //     $line->_pushguestLine(null, $event, "wait");
            //     $line->reply_success($event , $data_postback);
            //     break;
        }

    }

    function check_help_complete_by_helper($event, $data_postback, $id_sos){

        $data = [
            "title" => "Line",
            "content" => $id_sos,
        ];
        MyLog::create($data);

        $data_sos = Ask_for_help::where("id" , $id_sos)->first();
        // $data_helpers = User::where('provider_id' , $event["source"]["userId"])->first();

        $data_groupline = Group_line::where('groupId',$event["source"]["groupId"])->first();
        $id_organization_helper = $data_groupline->partner_id ;
        $data_partner_helpers = Partner::findOrFail($id_organization_helper);

        if (!empty($data_sos->helper_id)) {

            // $data = [
            //     "title" => "เข้า if ",
            //     "content" => "function check_help_complete_by_helper",
            // ];
            // MyLog::create($data);

                $this->reply_success_groupline($event , $data_postback, $id_sos);
                // $this->help_complete($id_sos);


        }else{

            // $data = [
            //     "title" => "เข้า else ",
            //     "content" => "function check_help_complete_by_helper",
            // ];
            // MyLog::create($data);

                // ไม่สามารถกดได้
                $this->This_help_is_done($data_partner_helpers, $event, "no_helper");
        }
    }

    public function save_group_line($event)
    {
        $opts = [
            'http' =>[
                'method'  => 'GET',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
            ]
        ];

        $group_id = $event['source']['groupId'];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/group/".$group_id."/summary";
        $result = file_get_contents($url, false, $context);

        $data_group_line = json_decode($result);

        $save_name_group = [
            "groupId" => $data_group_line->groupId,
            "groupName" => $data_group_line->groupName,
            "pictureUrl" => $data_group_line->pictureUrl,
        ];

        Group_line::firstOrCreate($save_name_group);

        $data = [
            "title" => "บันทึก Name Group Line",
            "content" => $data_group_line->groupName,
        ];
        MyLog::create($data);


        //ฟังก์ชั่น ส่งทักทาย กลุ่มไลน์ใหม่
        // $line = new LineMessagingAPI();
        // $line->send_HelloLinegroup($event,$save_name_group);

    }

    // public function sos_helper($data_postback_explode , $provider_id , $event)
    // {
    //      // SAVE LOG
    //      $data = [
    //         "title" => "เข้า sos_helper",
    //         "content" => "line 220",
    //     ];
    //     MyLog::create($data);
    //     $data_data = explode("/",$data_postback_explode);

    //     $id_sos = $data_data[0] ;
    //     $id_organization_helper = $data_data[1] ;

    //     $data_sos = Ask_for_help::findOrFail($id_sos);

    //     $data_partner_helpers = Partner::findOrFail($id_organization_helper);

    //     $users = DB::table('users')->where('provider_id', $provider_id)->first();

    //     // ตรวจสอบ "การช่วยเหลือเสร็จสิ้น" แล้วหรือยัง
    //     if ($data_sos->help_complete == "Yes") { // การช่วยเหลือเสร็จสิ้น

    //         // ส่งไลน์การช่วยเหลือนี้เสร็จสิ้นแล้ว
    //         $this->This_help_is_done($data_partner_helpers, $event, "This_help_is_done");

    //     }else{ // การช่วยเหลือ อยู่ระหว่างดำเนินการ

    //         // ตรวจสอบการเป็นสมาชิก
    //         if (!empty($users)) { // เป็นสมาชิก

    //                 // ตรวจสอบสถานนะ role
    //             if (!empty($users->role)) {
    //                 //อัพเดต ชื่อหน่วยงาน
    //                 DB::table('users')
    //                     ->where('provider_id', $provider_id)
    //                     ->update([
    //                         'organization' => $data_partner_helpers->name,
    //                 ]);

    //             }else{
    //                 //อัพเดต ชื่อหน่วยงาน + role partner
    //                 DB::table('users')
    //                     ->where('provider_id', $provider_id)
    //                     ->update([
    //                         'organization' => $data_partner_helpers->name,
    //                         'role' => 'partner',
    //                 ]);
    //             }

    //                // ตรวจสอบรายชื่อคนช่วยเหลือ
    //             if (!empty($data_sos->helper_id)) { // ถ้ามีไอดีคนช่วยเหลือ

    //                     // คุณได้ทำการกด "กำลังไปช่วยเหลือ" ซ้ำ
    //                     $this->This_help_is_done($data_partner_helpers, $event , "helper_click_double");

    //             }else {

    //                 DB::table('ask_for_helps')
    //                     ->where('id', $id_sos)
    //                     ->update([
    //                         'name_helper' => $users->name,
    //                         'helper_id' => $users->id,
    //                         'time_go_to_help' => date('Y-m-d\TH:i:s'),
    //                 ]);

    //                 $this->_send_helper_to_groupline($data_sos , $data_partner_helpers , $users->name , $users->id ,$event);

    //             }

    //         }else{ // ไม่ได้เป็นสมาชิก
    //             // return redirect('login/line');
    //             $this->_send_register_to_groupline($data_partner_helpers, $event);

    //         }


    //     }

    // }

    protected function _send_register_to_groupline($data_partner_helpers , $event)
    {
        //กรุณาลงทะเบียนเพื่อเริ่มใช้งาน
        // $data_line_group = DB::table('group_lines')
        //         ->where('groupId', $data_partner_helpers->line_group_id)
        //         ->first();


        $template_path = storage_path('../public/json/register_line.json');
        $string_json = file_get_contents($template_path);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        // SAVE LOG
        $data = [
            "title" => "กรุณาลงทะเบียนเพื่อเริ่มใช้งาน",
            "content" => "กรุณาลงทะเบียนเพื่อเริ่มใช้งาน",
        ];
        MyLog::create($data);
    }

    protected function _send_helper_to_groupline($data_sos , $data_partner_helpers , $name_helper , $helper_id , $event)
    {
        // $data_line_group = DB::table('group_lines')
        //             ->where('id', $data_partner_helpers->line_group_id)
        //             ->first();
        // datetime

          // SAVE LOG
          $data222 = [
            "title" => "ข้อมูลsosที่ส่งมา",
            "content" => "เข้า _send_helper_to_groupline",
        ];
        MyLog::create($data222);

        $data_time_go_to_help = DB::table('ask_for_helps')
                    ->where('id', $data_sos->id)
                    ->first();

        $time_zone_explode = explode(" ",$data_time_go_to_help->time_go_to_help);

        $date = $time_zone_explode[0] ;
        $time = $time_zone_explode[1] ;

        // SAVE LOG
        $data222 = [
            "title" => "วันเวลา",
            "content" => $date . "-" . $time,
        ];
        MyLog::create($data222);

        $template_path = storage_path('../public/json/flex_sos_helper_to_groupline.json');
        $string_json = file_get_contents($template_path);

        // // user
        $string_json = str_replace("name_user",$data_sos->name_user,$string_json);

        // helper
        $string_json = str_replace("name_helper",$name_helper,$string_json);
        $string_json = str_replace("date",$date,$string_json);
        $string_json = str_replace("time",$time,$string_json);
        $string_json = str_replace("id_sos_map",$data_sos->id,$string_json);


        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        // SAVE LOG
        $data = [
            "title" => "send_helper_to_groupline",
            "content" => $name_helper . "กำลังไปช่วย" . $data_sos->name,
        ];
        MyLog::create($data);

        // ส่งไลน์หา user ที่ขอความช่วยเหลือ
        $this->_send_helper_to_user($helper_id , $data_sos , $data_partner_helpers->name);

    }


    protected function This_help_is_done($data_partner_helpers, $event , $type)
    {
        //การช่วยเหลือนี้เสร็จสิ้นแล้ว
        $data_line_group = DB::table('group_lines')
            ->where('id', $data_partner_helpers->line_group_id)
            ->first();

        // TIME ZONE
        // $API_Time_zone = new API_Time_zone();
        // $time_zone = $API_Time_zone->change_Time_zone($name_time_zone);

        if ($type == "helper_click_double") {
            $data_topic = [
                    "ขออภัยค่ะมีการดำเนินการแล้ว ขอบคุณค่ะ",
                ];
        }elseif ($type == "no_helper") {
            $data_topic = [
                    "ขออภัยค่ะ คุณไม่ได้ทำการกดกำลังไปช่วยเหลือ",
                ];
        }else{
            $data_topic = [
                    "การช่วยเหลือนี้เสร็จสิ้นแล้ว",
                ];
        }

        $template_path = storage_path('../public/json/flex_text_done.json');
        $string_json = file_get_contents($template_path);

        $string_json = str_replace("ขออภัยค่ะมีการดำเนินการแล้ว ขอบคุณค่ะ",$data_topic[0],$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        // SAVE LOG
        $data = [
            "title" => "replyToken TO : " . $data_partner_helpers->line_group,
            "content" => 'ขออภัยค่ะมีการดำเนินการแล้ว ขอบคุณค่ะ',
        ];
        MyLog::create($data);
    }


    protected function _send_helper_to_user($helper_id , $data_sos , $name_partner_helpers )
    {

        $user = DB::table('users')->where('id', $data_sos->user_id)->first();
        $data_helper = DB::table('users')->where('id', $helper_id)->first();

            // $user_language = $user->language ;

            // TIME ZONE
            // $API_Time_zone = new API_Time_zone();
            // $time_zone = $API_Time_zone->change_Time_zone($user->time_zone);

            $data_time_go_to_help = DB::table('ask_for_helps')
                    ->where('id', $data_sos->id)
                    ->first();

            //date time
            $time_zone_explode = explode(" ",$data_time_go_to_help->time_go_to_help);

            $date = $time_zone_explode[0] ;
            $time = $time_zone_explode[1] ;

            $template_path = storage_path('../public/json/flex_helper_to_user.json');
            $string_json = file_get_contents($template_path);

            $string_json = str_replace("date",$date,$string_json);
            $string_json = str_replace("time",$time,$string_json);
            // $string_json = str_replace("UTC", "UTC " . $utc,$string_json);

            // user
            $string_json = str_replace("user_name",$user->name,$string_json);

            //helper

            if (!empty($data_helper->photo)) {
                $photo_helper = "https://www.viicheck.com/storage/".$data_helper->photo ;
            }
            if (empty($data_helper->photo)) {
                $photo_helper = $data_helper->avatar ;
            }

            $name_helper = $data_helper->name ;

            $string_json = str_replace("name_helper",$name_helper,$string_json);
            $string_json = str_replace("https://scdn.line-apps.com/clip13.jpg",$photo_helper,$string_json);
            $string_json = str_replace("zzz",$name_partner_helpers,$string_json);

            $messages = [ json_decode($string_json, true) ];

            $body = [
                "to" => $user->provider_id,
                "messages" => $messages,
            ];

            $opts = [
                'http' =>[
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/json \r\n".
                                'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                    'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                    //'timeout' => 60
                ]
            ];

            $context  = stream_context_create($opts);
            $url = "https://api.line.me/v2/bot/message/push";
            $result = file_get_contents($url, false, $context);

            // SAVE LOG
            $data = [
                "title" => "send_helper_to_user",
                "content" => $user->name . 'รอรับการช่วยเหลือจากเจ้าหน้าที่',
            ];
            MyLog::create($data);

    }

    // protected function help_complete($id_sos_map)
    // {
    //     $data_sos_map = Sos_map::findOrFail($id_sos_map);

    //     if (!empty($data_sos_map->condo_id)) {
    //         $condo_id = $data_sos_map->condo_id ;
    //     }else{
    //         $condo_id = null ;
    //     }

    //     if (!empty($condo_id)) {
    //         $data_condos = Partner_condo::where('id' , $condo_id)->first();
    //         $channel_access_token = $data_condos->channel_access_token ;
    //     }else{
    //         $channel_access_token = env('CHANNEL_ACCESS_TOKEN') ;
    //     }

    //     $data_users = User::findOrFail($data_sos_map->user_id);
    //     $date_now = date('Y-m-d\TH:i:s');

    //     if ($data_sos_map->help_complete != 'Yes') {

    //         DB::table('sos_maps')
    //             ->where('id', $id_sos_map)
    //             ->update([
    //                 'help_complete' => 'Yes',
    //                 'help_complete_time' => $date_now,
    //         ]);

    //         $user_language = $data_users->language ;

    //         // TIME ZONE
    //         $API_Time_zone = new API_Time_zone();
    //         $time_zone = $API_Time_zone->change_Time_zone($data_users->time_zone);

    //         // datetime
    //         $time_zone_explode = explode(" ",$time_zone);

    //         $date = $time_zone_explode[0] ;
    //         $time = $time_zone_explode[1] ;
    //         $utc = $time_zone_explode[3] ;

    //         $data_topic = [
    //                     "บอกให้เรารู้",
    //                     "การช่วยเหลือเป็นอย่างไรบ้าง",
    //                     "พื้นที่",
    //                     "ให้คะแนน",
    //                 ];

    //         for ($xi=0; $xi < count($data_topic); $xi++) {

    //             $text_topic = DB::table('text_topics')
    //                     ->select($user_language)
    //                     ->where('th', $data_topic[$xi])
    //                     ->where('en', "!=", null)
    //                     ->get();

    //             foreach ($text_topic as $item_of_text_topic) {
    //                 $data_topic[$xi] = $item_of_text_topic->$user_language ;
    //             }
    //         }
    //         //logo organization helper
    //         $data_helpers = DB::table('partners')->where('name', $data_sos_map->organization_helper)
    //             ->where('name_area', "=", null)
    //             ->get();


    //          foreach ($data_helpers as $data_helper) {

    //             if (!empty($data_helper->logo)) {
    //                 $logo_organization = "https://www.viicheck.com/storage/".$data_helper->logo ;
    //             }
    //             if (empty($data_helper->logo)) {
    //                 $logo_organization = "https://www.viicheck.com/img/stickerline/PNG/1.png" ;
    //             }

    //         }

    //         $template_path = storage_path('../public/json/rate_help.json');
    //         $string_json = file_get_contents($template_path);

    //         $string_json = str_replace("ตัวอย่าง",$data_topic[3],$string_json);
    //         $string_json = str_replace("date",$date,$string_json);
    //         $string_json = str_replace("time",$time,$string_json);
    //         $string_json = str_replace("UTC", "UTC " . $utc,$string_json);
    //         $string_json = str_replace("area",$data_sos_map->organization_helper,$string_json);
    //         $string_json = str_replace("https://scdn.line-apps.com/clip13.jpg",$logo_organization,$string_json);
    //         $string_json = str_replace("id_sos_map",$id_sos_map,$string_json);

    //         $string_json = str_replace("บอกให้เรารู้",$data_topic[0],$string_json);
    //         $string_json = str_replace("การช่วยเหลือเป็นอย่างไรบ้าง",$data_topic[1],$string_json);
    //         $string_json = str_replace("พื้นที่",$data_topic[2],$string_json);
    //         $string_json = str_replace("ให้คะแนน",$data_topic[3],$string_json);

    //         $messages = [ json_decode($string_json, true) ];

    //         $body = [
    //             "to" => $data_users->provider_id,
    //             "messages" => $messages,
    //         ];

    //         $opts = [
    //             'http' =>[
    //                 'method'  => 'POST',
    //                 'header'  => "Content-Type: application/json \r\n".
    //                             'Authorization: Bearer '. $channel_access_token,
    //                 'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
    //                 //'timeout' => 60
    //             ]
    //         ];

    //         $context  = stream_context_create($opts);
    //         $url = "https://api.line.me/v2/bot/message/push";
    //         $result = file_get_contents($url, false, $context);

    //         // SAVE LOG
    //         $data = [
    //             "title" => "แบบฟอร์มให้คะแนนการช่วยเหลือ",
    //             "content" => $data_users->name,
    //         ];
    //         MyLog::create($data);
    //     }

    // }

    // public function reply_success_groupline($event , $data_postback , $id_sos)
    // {
    //     $data_sos_map = Ask_for_help::where("id" , $id_sos)->first();

    //     $data_line_group = DB::table('group_lines')
    //         ->where('groupId', $event['source']['groupId'])
    //         ->first();

    //     $date_sos = $data_sos_map->created_at->format('d/m/Y');
    //     $time_sos = $data_sos_map->created_at->format('g:i:sa');

    //     $data_time_help = $data_sos_map->time_go_to_help;
    //     $date_time_help = strtotime($data_time_help);

    //     $date_help = date('d/m/Y', $date_time_help);
    //     $time_help = date('g:i:sa', $date_time_help);

    //     //datetime success
    //     $time_zone_explode = explode(" ",$data_sos_map->time_go_to_help);

    //     $date_success = date('d/m/Y', strtotime($time_zone_explode[0]));
    //     $time_success = date('g:i:sa', strtotime($time_zone_explode[1]));

    //     $time_created = $data_sos_map->created_at;
    //     $time_help_complete = $data_sos_map->help_complete_time;

    //     $time_go_to_help = $data_sos_map->time_go_to_help;

    //     //crash
    //     $count_time_help = $this->count_range_time($time_created , $time_go_to_help);
    //     $count_success = $this->count_range_time($time_go_to_help , $time_help_complete);
    //     $count_complete = $this->count_range_time($time_created , $time_help_complete);

    //     //สถานะการช่วยเหลือ เสร็จสิ้น
    //     if (empty($data_sos_map->help_complete) ) {

    //         $data_topic = [
    //                     "ขอขอบคุณที่ร่วมสร้างสังคมที่ดีค่ะ",
    //                     "การช่วยเหลือเสร็จสิ้น",
    //                     "เพิ่มภาพถ่าย",
    //                     "ขอความช่วยเหลือ",
    //                     "กำลังไปช่วยเหลือ",
    //                     "ช่วยเหลือเสร็จสิ้น",
    //                     "ใช้เวลา",
    //                 ];

    //         $template_path = storage_path('../public/json/flex_sos_map_success.json');
    //         $string_json = file_get_contents($template_path);

    //         // sos
    //         $string_json = str_replace("name_sos",$data_sos_map->name_user,$string_json);
    //         $string_json = str_replace("date_sos",$date_sos,$string_json);
    //         $string_json = str_replace("time_sos",$time_sos,$string_json);

    //         //help
    //         $string_json = str_replace("name_help",$data_sos_map->name_helper,$string_json);
    //         $string_json = str_replace("date_help",$date_help,$string_json);
    //         $string_json = str_replace("time_help",$time_help,$string_json);
    //         $string_json = str_replace("count_help",$count_time_help,$string_json);

    //         // success
    //         $string_json = str_replace("date_success",$date_success,$string_json);
    //         $string_json = str_replace("time_success",$time_success,$string_json);
    //         $string_json = str_replace("count_success",$count_success,$string_json);

    //         $string_json = str_replace("count_complete",$count_complete,$string_json);
    //         $string_json = str_replace("date_time",$data_sos_map->time_go_to_help,$string_json);
    //         $string_json = str_replace("id_sos_map",$id_sos,$string_json);

    //         $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
    //         $string_json = str_replace("ขอขอบคุณที่ร่วมสร้างสังคมที่ดีค่ะ",$data_topic[0],$string_json);
    //         $string_json = str_replace("การช่วยเหลือเสร็จสิ้น",$data_topic[1],$string_json);
    //         $string_json = str_replace("เพิ่มภาพถ่าย",$data_topic[2],$string_json);
    //         $string_json = str_replace("ขอความช่วยเหลือ",$data_topic[3],$string_json);
    //         $string_json = str_replace("กำลังไปช่วยเหลือ",$data_topic[4],$string_json);
    //         $string_json = str_replace("ช่วยเหลือเสร็จสิ้น",$data_topic[5],$string_json);
    //         $string_json = str_replace("ใช้เวลา",$data_topic[6],$string_json);


    //         $messages = [ json_decode($string_json, true) ];

    //         $body = [
    //             "replyToken" => $event["replyToken"],
    //             "messages" => $messages,
    //         ];

    //         $opts = [
    //             'http' =>[
    //                 'method'  => 'POST',
    //                 'header'  => "Content-Type: application/json \r\n".
    //                             'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
    //                 'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
    //                 //'timeout' => 60
    //             ]
    //         ];

    //         $context  = stream_context_create($opts);
    //         //https://api-data.line.me/v2/bot/message/11914912908139/content
    //         $url = "https://api.line.me/v2/bot/message/reply";
    //         $result = file_get_contents($url, false, $context);

    //         //SAVE LOG
    //         $data = [
    //             "title" => "MithCare ขอขอบคุณที่ร่วมสร้างสังคมที่ดีค่ะ",
    //             "content" => "reply Success",
    //         ];
    //         MyLog::create($data);

    //         return $result;

    //     }else{

    //         $data_topic = [
    //                     "ขออภัยค่ะมีการดำเนินการแล้ว ขอบคุณค่ะ",
    //                 ];

    //         $template_path = storage_path('../public/json/text_done.json');

    //         $string_json = file_get_contents($template_path);

    //         $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
    //         $string_json = str_replace("ขออภัยค่ะมีการดำเนินการแล้ว ขอบคุณค่ะ",$data_topic[0],$string_json);

    //         $messages = [ json_decode($string_json, true) ];

    //         $body = [
    //             "replyToken" => $event["replyToken"],
    //             "messages" => $messages,
    //         ];

    //         $opts = [
    //             'http' =>[
    //                 'method'  => 'POST',
    //                 'header'  => "Content-Type: application/json \r\n".
    //                             'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
    //                 'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
    //                 //'timeout' => 60
    //             ]
    //         ];

    //         $context  = stream_context_create($opts);
    //         //https://api-data.line.me/v2/bot/message/11914912908139/content
    //         $url = "https://api.line.me/v2/bot/message/reply";
    //         $result = file_get_contents($url, false, $context);

    //         //SAVE LOG
    //         $data = [
    //             "title" => "ขออภัยค่ะมีการดำเนินการแล้ว ขอบคุณค่ะ",
    //             "content" => "reply Success",
    //         ];
    //         MyLog::create($data);

    //         return $result;

    //     }

    // }

    public function count_range_time($time_start , $time_end)
    {
        // count time success
        $time_s = \Carbon\Carbon::parse($time_end)->diff(\Carbon\Carbon::parse($time_start))->format('%s');
        $time_i = \Carbon\Carbon::parse($time_end)->diff(\Carbon\Carbon::parse($time_start))->format('%i');
        $time_h = \Carbon\Carbon::parse($time_end)->diff(\Carbon\Carbon::parse($time_start))->format('%h');
        $time_d = \Carbon\Carbon::parse($time_end)->diff(\Carbon\Carbon::parse($time_start))->format('%d');
        $time_m = \Carbon\Carbon::parse($time_end)->diff(\Carbon\Carbon::parse($time_start))->format('%m');
        $time_y = \Carbon\Carbon::parse($time_end)->diff(\Carbon\Carbon::parse($time_start))->format('%y');

        if ( $time_s != 0 ) {
            $data = $time_s ." sec";
        }
        if( $time_i != 0){
            $data = $time_i ." min " .$data;
        }
        if( $time_h != 0){
            $data = $time_h ." hours " .$data;
        }
       if( $time_d != 0){
            $data = $time_d ." day " .$data;
        }
        if( $time_m != 0){
            $data = $time_m ." month " .$data;
        }
        if( $time_y != 0){
            $data = $time_y ." year " .$data;
        }
        return $data;
    }


}
