<?php


namespace App\Http\Controllers;
use Willywes\AgoraSDK\RtcTokenBuilder;
use App\User;
use App\Models\Room;
use App\Models\RoomRTC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\MakeAgoraCall;
use App\Models\Member_of_room;

class AgoraVideoController extends Controller
{
    public function index(Request $request,$room_id,$user_id)
    {
        $requestData = $request->all();
        $videoTrack = $requestData['videoTrack'];
        $audioTrack = $requestData['audioTrack'];
        // fetch all users apart from the authenticated user
        // $users = User::where('id', '<>', Auth::id())->get();
        $roomData = Member_of_room::where('room_id',$room_id)->get();

        return view('room.room_rtc.room_call', compact('user_id','room_id','roomData','videoTrack','audioTrack'));
    }

    public function token(Request $request)
    {
        $requestData = $request->all();
        $login_id = Auth::id();
        $room_id = $requestData['room_id'];
        $user_id = $requestData['user_id'];

        $appID = 'acb41870f41c48d4a42b7b0ef1532351';
        $appCertificate = '41aa313ac49f4e3d81f1a3056e122ca0';
        // $channelName = 'MithCare'.$room_id.$user_id;
        $channelName = 'MithCare';
        $user = $login_id;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 600;
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
        // $users = User::where('id', $requestData['userId'])->first();

        $users = User::join('member_of_rooms', 'users.id', '=', 'member_of_rooms.user_id')
                // ->where('member_of_rooms.room_id', $requestData['homeId'])
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

        $dateNow = date("Y-m-d H:i:s");
        $rtcTimeStart = "";
        $dataRoomRTC = RoomRTC::where('room_id',$room_id)->where('room_of_members',$room_of_members)->first();

        if($dataRoomRTC->amount_meet == null){
            $newAmountMeet = 1;
        }else{
            $newAmountMeet = (int)$dataRoomRTC->amount_meet + 1;
        }

        if($dataRoomRTC->time_start == null){
            DB::table('room_rtc')
                ->where('room_id', $room_id)
                ->where('room_of_members', $room_of_members)
                ->update([
                    'time_start' => $dateNow,
                    'amount_meet' => $newAmountMeet,
            ]);
            $rtcTimeStart = $dateNow;
        }else{
            $rtcTimeStart = $dataRoomRTC->time_start;
        }

        $roomVideocallStats = [
            "room_name" => $roomFinder['name'],
            // "time_start" => $requestData['time_start'],
            "current_people" => $requestData['current_people'],
            // "total_timemeet" => $requestData['total_timemeet'],
            // "amount_meet" => $requestData['current_people'],

            // เพิ่ม field อื่นๆ ตามต้องการ
        ];

        RoomRTC::updateOrCreate($room_data, $roomVideocallStats);

        return $rtcTimeStart;
    }

    public function checkPeopleInRoom(Request $request)
    {
        $requestData = $request->all();

        $room_id = $requestData['room_id'];

        $dataRoomRTC = RoomRTC::where('room_id', $room_id)->get();

        return $dataRoomRTC;
    }

    public function leaveChannel(Request $request)
    {
        $requestData = $request->all();

        $room_id = $requestData['room_id'];
        $room_of_members = $requestData['room_of_members'];

        $roomFinder = Room::where('id',$room_id)->first();

        $room_data = [
            "room_id" => $room_id,
            "room_of_members" => $room_of_members,
        ];

        $dataRoomRTC = RoomRTC::where('room_id',$room_id)->where('room_of_members',$room_of_members)->first();
        if((int)$dataRoomRTC->current_people <= 1){
            $updateDataRoomRTC = 0;
        }else{
            $updateDataRoomRTC = (int)$dataRoomRTC->current_people - 1;
        }

        if($updateDataRoomRTC == 0){
            // วันที่และเวลาปัจจุบัน
            $currentTime = time();

            // วันที่และเวลาที่กำหนด
            $targetDateTime = $dataRoomRTC->time_start;
            $targetTime = strtotime($targetDateTime);

            // คำนวณเวลาที่ผ่านไปในวินาที
            $elapsedTime = $currentTime - $targetTime;

            if($dataRoomRTC->total_timemeet == null){
                $updateTotalTimeMeet = $elapsedTime;
            }else{
                $updateTotalTimeMeet = (int)$elapsedTime + (int)$dataRoomRTC->total_timemeet;
            }

            DB::table('room_rtc')
                ->where('room_id', $room_id)
                ->where('room_of_members', $room_of_members)
                ->update([
                    'time_start' => null,
                    'total_timemeet' => $updateTotalTimeMeet,
            ]);
        }

        $roomVideocallStats = [
            // "room_name" => $roomFinder['name'],
            // "time_start" => $requestData['time_start'],
            "current_people" => $updateDataRoomRTC,
            // "total_timemeet" => $requestData['total_timemeet'],
            // "amount_meet" => $requestData['current_people'],

            // เพิ่ม field อื่นๆ ตามต้องการ
        ];

        RoomRTC::updateOrCreate($room_data, $roomVideocallStats);

        return $roomVideocallStats;
    }

    public function localPlayerData(Request $request)
    {
        $requestData = $request->all();

        $room_id = $requestData['room_id'];
        $user_id = $requestData['user_id'];

        $localPlayer = Member_of_room::where('room_id',$room_id)->where('user_id',$user_id)->first();

        return $localPlayer;
    }

}
