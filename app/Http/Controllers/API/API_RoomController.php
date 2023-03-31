<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member_of_room;
use Illuminate\Support\Facades\DB;

class API_RoomController extends Controller
{
    public function get_data_member(Request $request,$room_id,$user_id,$status)
    {
        $requestData = $request->all();
        if($status == 'member'){
            $room = Member_of_room::where('room_id',$room_id)->where('status','=','patient')->where('caregiver','=',$user_id)->get();
        }
        return $room;
    }

}
