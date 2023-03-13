<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Mylog;
use App\Models\Appoint;
use App\User;
use SebastianBergmann\CodeCoverage\Report\Xml\Source;

// use Carbon\Carbon;

class LineMessagingAPI extends Model
{
    // public $channel_access_token = env('CHANNEL_ACCESS_TOKEN');

    public function reply_success($event , $data_postback)
    {
        $data_Text_topic = [
            "ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ",
        ];

        $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

        $template_path = storage_path('../public/json/text_success.json');

        $string_json = file_get_contents($template_path);
        $string_json = str_replace("ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ",$data_topic[0],$string_json);
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
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ",
            "content" => "reply Success",
        ];
        MyLog::create($data);
        return $result;

    }

    // public function send_HelloLinegroup($event,$save_name_group)
    // {
    //     $template_path = storage_path('../public/json/hello_group_line.json');
    //     $string_json = file_get_contents($template_path);
    //     $string_json = str_replace("ตัวอย่าง","สวัสดีค่ะ",$string_json);
    //     $string_json = str_replace("GROUP",$save_name_group['groupName'],$string_json);

    //     $messages = [ json_decode($string_json, true) ];

    //     $body = [
    //         "replyToken" => $event["replyToken"],
    //         "messages" => $messages,
    //     ];

    //     $opts = [
    //         'http' =>[
    //             'method'  => 'POST',
    //             'header'  => "Content-Type: application/json \r\n".
    //                         'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
    //             'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
    //             //'timeout' => 60
    //         ]
    //     ];

    //     $context  = stream_context_create($opts);
    //     //https://api-data.line.me/v2/bot/message/11914912908139/content
    //     $url = "https://api.line.me/v2/bot/message/reply";
    //     $result = file_get_contents($url, false, $context);

    //     //SAVE LOG
    //     $data = [
    //         "title" => "HELLO LINE GROUP",
    //         "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
    //     ];

    //     MyLog::create($data);

    // }

    public function replyToUser($event, $message_type)
    {
        switch ($message_type) {
            case 'test':
                $template_path = storage_path('../public/json/text.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("ตัวอย่าง" , "อันนี้เแลี่ยนแล้วนะ" ,$string_json);
                $string_json = str_replace("hello" , "ทดสอบอะไร" ,$string_json);
                break;
            case 'register':
                $template_path = storage_path('../public/json/flex_test.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("ตัวอย่าง" , "ยังไม่ได้เปิดครับ" ,$string_json);
                // $string_json = str_replace("https://scdn.line-apps.com/n/channel_devcenter/img/flexsnapshot/clip/clip1.jpg" , "https://www.mithcare.com/img/logo_mithcare/logo_mithcare(%E0%B9%81%E0%B8%99%E0%B8%A7%E0%B8%99%E0%B8%AD%E0%B8%99).png" ,$string_json);
                $string_json = str_replace("วันที่เกิดเหตุ" , "ไม่อยู่" ,$string_json);
                $string_json = str_replace("วันที่" , "ไป" ,$string_json);
                break;

                // โรงพยาบาล และ ร้านยา ใกล้ฉัน
            case 'select_menu_hnd':
                $template_path = storage_path('../public/json/flex_hnd.json');
                $string_json = file_get_contents($template_path);
                break;
                // อื่นๆ
            case 'select_menu_other':
                $template_path = storage_path('../public/json/flex_other.json');
                $string_json = file_get_contents($template_path);
                break;
                // ครอบครัวของฉัน
            case 'select_my_room':
                $template_path = storage_path('../public/json/flex_room_menu.json');
                $string_json = file_get_contents($template_path);
                break;


            default:
                $template_path = storage_path('../public/json/text.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("hello" , "สวัสดีครับ" ,$string_json);
                break;
        }

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
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "reply test",
            "content" => "reply test",
        ];
        MyLog::create($data);
        return $result;

    }

    public function select_reply( $event, $postback_data, $data)
    {
         //SAVE LOG
        $data_savelog = [
            "title" => "เข้า select_reply function",
            "content" =>"เข้า select_reply function",
        ];

        Mylog::Create($data_savelog);


        switch($postback_data){
            case "accept_pill" :
                $id_appoint = $data;

                $appoint = Appoint::where('id',$id_appoint)->first();
                if($appoint->status == 'success'){
                    $text_sendto_user = "ขออภัยค่ะ รายการนี้ดำเนินการเรียบร้อยแล้ว";
                }else{
                    $text_sendto_user = "ยืนยันทานยา/ใช้ยาเรียบร้อยแล้วค่ะ ขอบคุณค่ะ";

                    DB::table('appoints')
                    ->where('id', $id_appoint)
                    ->update([
                        'status' => 'success',
                    ]);

                }
                $template_path = storage_path('../public/json/flex_accept_reply.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("ยีนยันทานยาเรียบร้อย" , $text_sendto_user ,$string_json);

                break;
        }



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
    //https://api-data.line.me/v2/bot/message/11914912908139/content
    $url = "https://api.line.me/v2/bot/message/reply";
    $result = file_get_contents($url, false, $context);

    //SAVE LOG
    $data_savelog = [
        "title" => "ส่งไลน์",
        "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
    ];

    Mylog::Create($data_savelog);

    }




}
