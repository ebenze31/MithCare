<?php

namespace App\Console\Commands;

use App\Models\Appoint;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Member_of_room;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;
use App\Models\Mylog;
use Illuminate\Support\Facades\DB;


class Send_Appoint_Doc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:appoint_doc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'แจ้งเตือนตารางนัดหมอ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

            $date_now = date("Y-m-d");
            $date_add_1 = date("Y-m-d", strtotime($date_now . ' +1 day'));

            // ค้นหา type=doc ,status_appoint ว่าเป็น null หรือ sent และวันที่ต้องน้อยกว่าหรือเท่ากับ ปัจจุบัน 1 วัน
            $ap_doc = Appoint:: where('type','=','doc')
            ->whereDate('date', '>=' , $date_now )
            ->whereDate('date', '<=' , $date_add_1 )
            ->where('status','=',null)
            ->get();

            for($i = 0; $i < count($ap_doc); $i++){

                // ค้นหา user_id สมาชิกในห้อง โดยหาจาก patient_id ที่ได้มา
                $data_members = Member_of_room::where('user_id',$ap_doc[$i]['patient_id'])->where('room_id',$ap_doc[$i]['room_id'])->first();

                if(!empty($data_members->lv_of_caretaker) && $data_members->lv_of_caretaker == 2){
                    // ถ้าเป็นผู้ป่วยเลเวล 2 ไม่สามารถดูแลตัวเองได้

                    $this->sentLineToPatient($ap_doc[$i],"tomember");

                    DB::table('appoints')
                    ->where('id', $ap_doc[$i]['id'])
                    ->update([
                        'status' => 'success',
                    ]);

                }else{
                    // LV_1 OR NULL
                    echo 'เป็นผู้ป่วย LV1 ดูแลตัวเองได้';
                    echo "<br>";

                    // LV_1 OR NULL กรณีไม่มีผู้ดูแล
                        $this->sentLineToPatient($ap_doc[$i],"tomember");

                        DB::table('appoints')
                        ->where('id', $ap_doc[$i]['id'])
                        ->update([
                            'status' => 'success',
                        ]);
                    // }


                }
            }

    }

    public function sentLineToPatient($data_doc,$sendto){

    //กรณี appoint เป็น นัดหมอ

        if($sendto == "tomember"){
            //เช็ค user_id จาก patient_id เพื่อหาข้อมูลผู้ใช้ ใน Member_Of_Room
        $data_check_patient = Member_of_room::where('user_id','=',$data_doc['patient_id'])->first();

            if($data_check_patient->caregiver != null){
                //กรณี user_id นี้มีคนดูแลอยู่
                // sendto Member
                $data_member_of_room = Member_of_room::where('user_id','=',$data_doc['patient_id'])->where('room_id',$data_doc['room_id'])->where('caregiver','!=',null)->first();


                $sendto = User::where('id','=',$data_member_of_room->caregiver)->first();
                $provider_id = $sendto->provider_id;

            }else{
                //กรณี user_id นี้มีไม่มีคนดูแล

                $sendto = User::where('id','=',$data_check_patient->user_id)->first();
                $provider_id = $sendto->provider_id;
            }
        }else{
            // sendto Patient
            $sendto = User::where('id','=',$data_doc['patient_id'])->first();
            $provider_id = $sendto->provider_id;
        }

        // echo 'ส่งแจ้งเตือนไปยัง ID : '.$sendto->id;
        $data_patient = User::where('id','=',$data_doc['patient_id'])->first();


        $template_path = storage_path('../public/json/flex_appoint_doc.json');
        $string_json = file_get_contents($template_path);

        $string_json = str_replace("User_name",$data_patient->name,$string_json);
        $string_json = str_replace("Title",$data_doc['title'],$string_json);
        $string_json = str_replace("date",$data_doc['date'],$string_json);



        $messages = [ json_decode($string_json, true) ];
        $body = [
            "to" => $provider_id,
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
