<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Member_of_room;
use Carbon\Carbon;
use App\Models\Appoint;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;
use App\Models\Mylog;

class TestController extends Controller
{

    public function test(Request $request)
    {

        $room_id = $request->get('room_id');
        $type = $request->get('type');
        $user_id = Auth::id();
        $check = "" ;


        // ===================
        // TEST APPOINT NOTI
        // ===================

        // $ap_test = Carbon::parse("2021-06-26 22:00:00")->addMinutes(10)->format('H:i:s');

        $time_10 = Carbon::now()->addMinutes(10)->format('H:i:s');
        $date_now = Carbon::now()->format('Y-m-d');

        $ap_pill_test = Appoint::where('status','=',null)
        ->orWhere('status','=','sent')
        ->where('room_id','=',$room_id)
        ->where('type','=','pill')
        ->where('date','<=',$date_now)
        ->where('date_time','<=',$time_10)
        ->get();

        echo count($ap_pill_test);
        echo "<br>=============================================================================================================<br>";
        for($i = 0; $i < count($ap_pill_test); $i++){

           echo $ap_pill_test[$i]['patient_id'];
           echo "<br>";
            $data_members = Member_of_room::where('user_id',$ap_pill_test[$i]['patient_id'])->where('room_id',$room_id)->first();
            if($data_members->lv_of_caretaker == 1){
                echo 'ดูแลตัวเองได้';
                echo "<br>";
                if($ap_pill_test[$i]['sent_round'] > 2){
                    echo 'ส่งมากกว่า 2 ครั้ง';
                    echo "<br>";
                }else{
                    echo 'ยังไม่ 2 ครั้ง';
                    echo "<br>";

                   $this->sentLineToPatient($ap_pill_test[$i]);

                }
            }else{
                echo 'ไม่สามารถดูแลตัวเองได้';
                echo "<br>";
            }

        //  echo"<pre>";
        //    print_r($data_members);
        //    echo"</pre>";

        }
 exit();

        // คนที่กำลังเข้าหน้าตารางนัดอยู่เป็นสมาชิกบ้านรึเปล่า
        $Member_of_room = Member_of_room::select('user_id')->where('room_id' , $room_id)->get();

        foreach ($Member_of_room as $key ) {
            if ($key->user_id == $user_id) {
                $check = "Yes" ;
            }
        }



        if ($check == "Yes"){
            $room = Room::where('id',$room_id)->first();

            if(!empty($type)){
                $appoint = Appoint::where('room_id', $room_id)->where('type' , $type)->get();
            }else{
                $appoint = Appoint::where('room_id', $room_id)->get();

            }

            return view('appoint.appoint_index', compact('room','room_id','appoint','type','ap_pill_test','date_now','time_10'));

        }else{
            return view('404');
        }

    }

    public function sentLineToPatient($data_pill){


        $data_patient = User::where('id','=',$data_pill['patient_id'])->first();

        echo $data_pill['title'];
        echo '<br>';
        echo $data_patient->provider_id;

        $template_path = storage_path('../public/json/flex_line_text.json');
        $string_json = file_get_contents($template_path);

        $string_json = str_replace("ใส่ข้อความตรงนี้ครับ",$data_pill['title'],$string_json);

        $messages = [ json_decode($string_json, true) ];
        $body = [
            "to" => $data_patient->provider_id,
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

        //SAVE LOG
        $data = [
            "title" => "ส่งไลน์",
            "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
        ];

        Mylog::Create($data);
    }
}
