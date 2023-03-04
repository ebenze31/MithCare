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
            // case "accept_pill" :
            //     $line->_pushguestLine(null, $event, "accept_pill");
            //     $line->reply_success($event , $data_postback);
            //     break;
            // case "wait" :
            //     $line->_pushguestLine(null, $event, "wait");
            //     $line->reply_success($event , $data_postback);
            //     break;
            // case "help_complete" :
            //     $this->check_help_complete_by_helper($event, $data_postback, $data_postback_explode[1]);
            //     break;
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

    public function sos_helper($data_postback_explode , $provider_id , $event)
    {
        $data_data = explode("/",$data_postback_explode);

        $id_sos = $data_data[0] ;
        $id_organization_helper = $data_data[1] ;

        $data_sos = Ask_for_help::findOrFail($id_sos);

        $data_partner_helpers = Partner::findOrFail($id_organization_helper);

        $users = DB::table('users')->where('provider_id', $provider_id)->first();

        // ตรวจสอบ "การช่วยเหลือเสร็จสิ้น" แล้วหรือยัง
        if ($data_sos->help_complete == "Yes") { // การช่วยเหลือเสร็จสิ้น

            // ส่งไลน์การช่วยเหลือนี้เสร็จสิ้นแล้ว
            $this->This_help_is_done($data_partner_helpers, $event, "This_help_is_done");

        }else{ // การช่วยเหลือ อยู่ระหว่างดำเนินการ

            // ตรวจสอบการเป็นสมาชิก
            if (!empty($users)) { // เป็นสมาชิก

                    // ตรวจสอบสถานนะ role
                if (!empty($users->role)) {
                    //อัพเดต ชื่อหน่วยงาน
                    DB::table('users')
                        ->where('provider_id', $provider_id)
                        ->update([
                            'organization' => $data_partner_helpers->name,
                    ]);

                }else{
                    //อัพเดต ชื่อหน่วยงาน + role partner
                    DB::table('users')
                        ->where('provider_id', $provider_id)
                        ->update([
                            'organization' => $data_partner_helpers->name,
                            'role' => 'partner',
                    ]);
                }

                   // ตรวจสอบรายชื่อคนช่วยเหลือ
                if (!empty($data_sos->helper_id)) { // ถ้ามีไอดีคนช่วยเหลือ

                        // คุณได้ทำการกด "กำลังไปช่วยเหลือ" ซ้ำ
                        $this->This_help_is_done($data_partner_helpers, $event , "helper_click_double");

                }else {

                    DB::table('ask_for_helps')
                        ->where('id', $id_sos)
                        ->update([
                            'name_helper' => $users->name,
                            'helper_id' => $users->id,
                            'time_go_to_help' => date('Y-m-d\TH:i:s'),
                    ]);

                    $this->_send_helper_to_groupline($data_sos , $data_partner_helpers , $users->name , $users->id ,$event);

                }

            }else{ // ไม่ได้เป็นสมาชิก
                // return redirect('login/line');
                $this->_send_register_to_groupline($data_partner_helpers, $event);

            }


        }

    }

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
        $time_zone_explode = explode(" ",$data_sos->time_go_to_help);

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

        $template_path = storage_path('../public/json/flex_text_done.json');
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

            // datetime
            $time_zone_explode = explode(" ",$data_sos->time_go_to_help);

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


}
