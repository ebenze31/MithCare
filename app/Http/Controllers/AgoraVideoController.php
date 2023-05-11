<?php


namespace App\Http\Controllers;
use Willywes\AgoraSDK\RtcTokenBuilder;
use App\User;
use App\Models\Room;
use App\Models\RoomRTC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\MakeAgoraCall;
use App\Models\Member_of_room;

class AgoraVideoController extends Controller
{
    public function index(Request $request,$room_id,$user_id)
    {
        $requestData = $request->all();

        // fetch all users apart from the authenticated user
        // $users = User::where('id', '<>', Auth::id())->get();

        return view('room.room_rtc.room_call', compact('user_id','room_id'));
    }

    public function token(Request $request)
    {
        $requestData = $request->all();
        $login_id = Auth::id();
        $room_id = $requestData['room_id'];
        $user_id = $requestData['user_id'];

        $appID = 'acb41870f41c48d4a42b7b0ef1532351';
        $appCertificate = '41aa313ac49f4e3d81f1a3056e122ca0';
        $channelName = 'MithCare'.$room_id.$user_id;
        $user = $login_id;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 900;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        // $token = [$appID,$appCertificate,$channelName,$user,$expireTimeInSeconds,$currentTimestamp,$privilegeExpiredTs,$role];
        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

        if($token){
            $token = $token;
        }else{
            $token = "ไม่มี TOKEN";
        }

        return $token;
    }


    public function callUser(Request $request)
    {
        $data['userToCall'] = $request->user_to_call;
        $data['channelName'] = $request->channel_name;
        $data['from'] = Auth::id();

        broadcast(new MakeAgoraCall($data))->toOthers();
    }

    public function getUserRemote(Request $request)
    {
        $requestData = $request->all();
        $users = User::where('id', $requestData['userId'])->first();

        $users = User::join('member_of_rooms', 'users.id', '=', 'member_of_rooms.user_id')
                ->where('users.id', $requestData['userId'])
                ->select('users.*','member_of_rooms.status as memberStatus','member_of_rooms.lv_of_caretaker as memberLv')
                ->first();

        return $users;
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $room_id = $requestData['room_id'];
        $room_of_members = $requestData['room_of_members'];

        $roomFinder = Room::where('id',$room_id)->first();

        $room_data = [
            "room_id" => $room_id,
            "room_of_members" => $room_of_members,
        ];

        $roomVideocallStats = [
            "room_name" => $roomFinder['name'],
            // "time_start" => $requestData['time_start'],
            "current_people" => $requestData['current_people'],
            // "total_timemeet" => $requestData['total_timemeet'],
            // "amount_meet" => $requestData['current_people'],

            // เพิ่ม field อื่นๆ ตามต้องการ
        ];

        RoomRTC::updateOrCreate($room_data, $roomVideocallStats);

        return $roomVideocallStats;
    }

}
