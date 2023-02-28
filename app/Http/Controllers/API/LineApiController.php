<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

        // $data_postback = $event["postback"]["data"] ;

        switch($data_postback){
            // case "accept_pill" :
            //     $line->_pushguestLine(null, $event, "accept_pill");
            //     $line->reply_success($event , $data_postback);
            //     break;
            // case "wait" :
            //     $line->_pushguestLine(null, $event, "wait");
            //     $line->reply_success($event , $data_postback);
            //     break;
            case "accept_pill" :
                $line->select_reply( $event, $data_postback , $data_postback_explode[1]);
                break;
            case "accept_doc" :
                $line->select_reply( $event, $data_postback , $data_postback_explode[1]);
                break;
            // case "help_complete" :
            //     $this->check_help_complete_by_helper($event, $data_postback, $data_postback_explode[1]);
            //     break;
            case "sos" :
                $this->sos_helper($data_postback_explode[1] , $event["source"]["userId"] , $event);
                break;
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

        $id_sos_map = $data_data[0] ;
        $id_organization_helper = $data_data[1] ;

        $data = [
            "title" => "check id",
            "content" => $id_organization_helper,
        ];
        MyLog::create($data);

        // $data_sos_map = Sos_map::findOrFail($id_sos_map);

        // if (!empty($data_sos_map->condo_id)) {
        //     $condo_id = $data_sos_map->condo_id ;
        // }else{
        //     $condo_id = null ;
        // }

        $data_partner_helpers = Partner::findOrFail($id_organization_helper);

        $users = DB::table('users')->where('provider_id', $provider_id)->get();

        // // ตรวจสอบ "การช่วยเหลือเสร็จสิ้น" แล้วหรือยัง
        // if ($data_sos_map->help_complete == "Yes") { // การช่วยเหลือเสร็จสิ้น

        //     // ส่งไลน์การช่วยเหลือนี้เสร็จสิ้นแล้ว
        //     $this->This_help_is_done($data_partner_helpers, $event, "This_help_is_done");

        // }else{ // การช่วยเหลือ อยู่ระหว่างดำเนินการ

        //     // ตรวจสอบการเป็นสมาชิก ViiCHECK
        //     if ($users != '[]') { // เป็นสมาชิก ViiCHECK

        //         foreach ($users as $user) {
        //             // ตรวจสอบสถานนะ role
        //             if (!empty($user->role)) {
        //                 DB::table('users')
        //                     ->where('provider_id', $provider_id)
        //                     ->update([
        //                         'organization' => $data_partner_helpers->name,
        //                 ]);
        //             }else{
        //                 DB::table('users')
        //                     ->where('provider_id', $provider_id)
        //                     ->update([
        //                         'organization' => $data_partner_helpers->name,
        //                         'role' => 'partner',
        //                 ]);
        //             }

        //             // ตรวจสอบรายชื่อคนช่วยเหลือ
        //             if (!empty($data_sos_map->helper)) {

        //                 $explode_helper_id = explode(",",$data_sos_map->helper_id);
        //                 for ($i=0; $i < count($explode_helper_id); $i++) {

        //                     if ($explode_helper_id[$i] != $user->id) {
        //                         $helper_double = "No";
        //                     }else{
        //                         $helper_double = "Yes";
        //                         break;
        //                     }

        //                 }

        //                 if ($helper_double != "Yes") {
        //                     DB::table('sos_maps')
        //                         ->where('id', $id_sos_map)
        //                         ->update([
        //                             'helper' => $data_sos_map->helper . ',' . $user->name,
        //                             'helper_id' => $data_sos_map->helper_id . ',' . $user->id,
        //                             'organization_helper' => $data_sos_map->organization_helper . ',' . $data_partner_helpers->name,
        //                     ]);

        //                     $this->_send_helper_to_groupline($data_sos_map , $data_partner_helpers , $user->name , $user->id , $condo_id) ;

        //                 }else{
        //                     // คุณได้ทำการกด "กำลังไปช่วยเหลือ" ซ้ำ
        //                     $this->This_help_is_done($data_partner_helpers, $event , "helper_click_double");
        //                 }

        //             }else {
        //                 DB::table('sos_maps')
        //                     ->where('id', $id_sos_map)
        //                     ->update([
        //                         'helper' => $user->name,
        //                         'helper_id' => $user->id,
        //                         'organization_helper' => $data_partner_helpers->name,
        //                         'time_go_to_help' => date('Y-m-d\TH:i:s'),
        //                 ]);

        //                 $this->_send_helper_to_groupline($data_sos_map , $data_partner_helpers , $user->name , $user->id , $condo_id);

        //             }

        //         }

        //     }else{ // ไม่ได้เป็นสมาชิก ViiCHECK
        //         // return redirect('login/line');
        //         $this->_send_register_to_groupline($data_partner_helpers);
        //     }
        // }

    }


}
