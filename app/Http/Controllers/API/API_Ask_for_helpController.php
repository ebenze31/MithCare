<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Ask_for_help;
use Illuminate\Support\Facades\Auth;
use App\User;

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

}
