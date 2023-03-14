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


class Send_Appoint_Pill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:appoint_pill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'แจ้งเตือนการใช้ยา';

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

        $time_10 = Carbon::now()->addMinutes(10)->toTimeString();
        $date_now = date("Y-m-d");

        // ค้นหา type=pill ,status_appoint ว่าเป็น null หรือ sent และวันที่กับเวลาต้องน้อยกว่าหรือเท่ากับ ปัจจุบัน+10นาที
        $ap_pill = Appoint:: where('type','=','pill')
        ->whereDate('date', '<=' , $date_now )
        ->whereTime('date_time','<=',$time_10)
        ->where('status','=',null)
        ->orWhere('status','=','sent')
        ->get();


        for($i = 0; $i < count($ap_pill); $i++){

            // ค้นหา user_id สมาชิกในห้อง โดยหาจาก patient_id ที่ได้มา
            $data_members = Member_of_room::where('user_id',$ap_pill[$i]['patient_id'])->where('room_id',$ap_pill[$i]['room_id'])->first();

            if(!empty($data_members->lv_of_caretaker) && $data_members->lv_of_caretaker == 2){
                // ถ้าเป็นผู้ป่วยเลเวล 2 ไม่สามารถดูแลตัวเองได้

                DB::table('appoints')
                ->where('id', $ap_pill[$i]['id'])
                ->update([
                    'status' => 'sent_success',
                    'sent_round' => 1,
                ]);


                $this->sentLineToPatient($ap_pill[$i],"tomember");

            }else{
                // LV_1 OR NULL
                echo 'เป็นผู้ป่วย LV1 ดูแลตัวเองได้';
                echo "<br>";
                    // ถ้าจำนวนการส่งเกิน 2 ครั้ง
                if($ap_pill[$i]['sent_round'] >= 2){
                    echo 'การส่งแจ้งเตือนมากกว่าหรือเท่ากับ 2 ครั้งแล้ว';
                    echo "<br>";

                    $this->sentLineToPatient($ap_pill[$i],"tomember");

                    DB::table('appoints')
                    ->where('id', $ap_pill[$i]['id'])
                    ->update([
                        'status' => 'sent_success',
                        'sent_round' => DB::raw('sent_round+1'),
                    ]);

                }else{
                    // ถ้าจำนวนการส่งยังไม่เกิน 2 ครั้ง
                    echo 'การส่งแจ้งเตือนยังไม่ 2 ครั้ง ' ;
                    echo "<br>";
                    $this->sentLineToPatient($ap_pill[$i],"topatient");


                    if(!empty($ap_pill[$i]['sent_round'])){
                        // ถ้า send_round ไม่เป็นค่าว่าง
                        DB::table('appoints')
                        ->where('id', $ap_pill[$i]['id'])
                        ->update([
                            'status' => 'sent',
                            'sent_round' => DB::raw('sent_round+1'),
                        ]);
                    }else{
                        //ถ้า send_round เป็นค่าว่าง
                        DB::table('appoints')
                        ->where('id', $ap_pill[$i]['id'])
                        ->update([
                            'sent_round' => 1,
                        ]);
                    }
                }
            }
        }

    }

    public function sentLineToPatient($data_pill,$sendto){

        $time = Carbon::now()->toTimeString();

        $count_pill = $this->count_range_time($time , $data_pill->date_time);

            //กรณี appoint เป็น ใช้ยา
            if($sendto == "tomember"){
                //เช็ค user_id จาก patient_id เพื่อหาข้อมูลผู้ใช้ ใน Member_Of_Room
                $data_check_patient = Member_of_room::where('user_id','=',$data_pill['patient_id'])->first();

                if($data_check_patient->caregiver != null){
                    //กรณี user_id นี้มีคนดูแลอยู่
                    // sendto Member
                    $data_member_of_room = Member_of_room::where('user_id','=',$data_pill['patient_id'])->where('room_id',$data_pill['room_id'])->where('caregiver','!=',null)->first();


                    $sendto = User::where('id','=',$data_member_of_room->caregiver)->first();
                    $provider_id = $sendto->provider_id;

                }else{
                    //กรณี user_id นี้มีไม่มีคนดูแล
                    echo 'คนนี้คือ คนที่ไม่มีผู้ดูแล';

                    $sendto = User::where('id','=',$data_check_patient->user_id)->first();
                    $provider_id = $sendto->provider_id;

                }
            }else{
                // sendto Patient
                $sendto = User::where('id','=',$data_pill['patient_id'])->first();
                $provider_id = $sendto->provider_id;

            }

            // echo 'ส่งแจ้งเตือนไปยัง ID : '.$sendto->id;
            $data_patient = User::where('id','=',$data_pill['patient_id'])->first();

            $template_path = storage_path('../public/json/flex_line_appoint.json');
            $string_json = file_get_contents($template_path);

            //ถ้ามีผู้ดูแล
            if(!empty($data_check_patient->caregiver)){
                    //เลยเวลาใช้ยา
                if($time > $data_pill['date_time']){
                    $string_json = str_replace("แจ้งเตือนทานยา/ใช้ยา","เลยเวลาทานยา/ใช้ยามา ".$count_pill,$string_json);
                    $string_json = str_replace("User_name","กรุณาติดต่อ : ".$data_patient->name,$string_json);
                }else{//ยังไม่เลยเวลาใช้ยา
                    $string_json = str_replace("User_name","กรุณาติดต่อ : ".$data_patient->name,$string_json);
                }
            }else{ //ถ้าไม่มีผู้ดูแล
                if($data_pill['sent_round'] >= 2 && $time > $data_pill['date_time']){//เลยเวลาใช้ยา
                    $string_json = str_replace("แจ้งเตือนทานยา/ใช้ยา","เลยเวลาทานยา/ใช้ยามา".$count_pill,$string_json);
                    $string_json = str_replace("User_name",$data_patient->name,$string_json);
                }else{//ยังไม่เลยเวลาใช้ยา
                    $string_json = str_replace("User_name",$data_patient->name,$string_json);
                }
            }

            $string_json = str_replace("Title",$data_pill['title'],$string_json);
            $string_json = str_replace("date",$data_pill['date'],$string_json);
            $string_json = str_replace("time",$data_pill['date_time'],$string_json);
            $string_json = str_replace("id_pill",$data_pill['id'],$string_json);



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
