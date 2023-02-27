<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mylog;
use App\Models\LineMessagingAPI;
use App\Models\Group_line;

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
        // echo"<pre>";
        // print_r( $event);
        // echo"</pre>";
        // exit();

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
            // case "sos" :
            //     $this->sos_helper($data_postback_explode[1] , $event["source"]["userId"] , $event);
            //     break;
            // case "Chinese" :
            //     $line->replyToUser(null, $event, "Chinese");
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
            "time_zone" => "Asia/Bangkok",
            "language" => "en",
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


}
