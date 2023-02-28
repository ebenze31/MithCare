<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Ask_for_help;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Group_line;
use App\Models\Mylog;

class API_Ask_for_helpController extends Controller
{
    public function get_sos_by_phone(Request $request)
    {
        //  $sos = $request->get('caretaker');
        $user_id = $request->get('user_id');
        //  $requestData = $request->all();
        //  $password_room = $request->get('pass');

        //  echo"<pre>";
        //  print_r( $user_id);
        //  echo"</pre>";
        //  exit();

         $requestData['user_id'] = $user_id;
         $requestData['content'] = "ชื่อหน่วยงานที่โทรหา";

         Ask_for_help::create($requestData);

        return $user_id;
        //  break;
    }

    public function get_sos_by_btn(Request $request)
    {
        $user_id = $request->get('user_id');
        $requestData = $request->all();
        $name_user = User::where('id',$user_id)->first();

        $requestData['name_user'] = $name_user->name;
        $requestData['user_id'] = $user_id;
        $requestData['content'] = "help_by_partner";
        $requestData['name_helper'] = "partner_name";
        $requestData['partner_id'] = "partner_id";
        $requestData['organization_helper'] = "name_partner";

        $ask_for_help = Ask_for_help::create($requestData);

         // หา $id_sos_map
        $sos_map_latests = Ask_for_help::get();
        foreach ($sos_map_latests as $latest) {
            $id_sos_map = $latest->id;
        }

         switch ($requestData['content']) {
             case 'help_by_partner':
                 // ตรวจสอบ area แล้วส่งข้อมูลผ่านไลน์
                 $this->send_Line_To_Group_SOS($requestData , $id_sos_map);
                 break;
         }

        return $ask_for_help;
        //  break;
    }

    public function update_info_sos(Request $request){
        $user_id = $request->get('user_id');

        $requestData = $request->all();

        $data_sos = User::findOrFail($user_id);
        $data_sos->update($requestData);


        return $data_sos ;
    }

    public function send_Line_To_Group_SOS($data_sos,$id_sos_map){

        $sosTo = "mithcare";
        $data_groupline = Group_line::where('owner','mithcare')->first();
        $text_at = "@";
         // sendto Provider_id
         $sendto = User::where('id','=',$data_sos['user_id'])->first();
         $provider_id = $sendto->provider_id;

        $template_path = storage_path('../public/json/flex_sos_from_ask_for_help.json');
        $string_json = file_get_contents($template_path);
        // กรณีเป็นนัดหมายของผู้ป่วยlv2 ให้แสดงชื่อผู้ป่วย แทนคนสร้าง

        $string_json = str_replace("User_name",$data_sos['name_user'],$string_json);
        $string_json = str_replace("จังหวัด",$data_sos['province'],$string_json);
        $string_json = str_replace("อำเภอ",$data_sos['district'],$string_json);
        $string_json = str_replace("ตำบล",$data_sos['sub_district'],$string_json);
        $string_json = str_replace("รายละเอียดที่อยู่",$data_sos['address'],$string_json);
        $string_json = str_replace("gg_lat",$data_sos['lat'],$string_json);
        $string_json = str_replace("gg_lng",$data_sos['lng'],$string_json);
        $string_json = str_replace("gg_lat_mail",$text_at.$data_sos['lat'],$string_json);
        $string_json = str_replace("0999999999",$sendto->phone,$string_json);

        $string_json = str_replace("id_sos_map",$id_sos_map,$string_json);

        $messages = [ json_decode($string_json, true) ];
        $body = [
            "to" => $data_groupline->groupId,
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
