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
        $roomData = Member_of_room::where('room_id',$room_id)->get();

        return view('room.room_rtc.room_call', compact('user_id','room_id','roomData','videoTrack','audioTrack'));
    }

    public function token(Request $request)
    {
        $requestData = $request->all();
        $login_id = Auth::id();
        $room_id = $requestData['room_id'];
        $user_id = $requestData['user_id'];

        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');

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

    public function member_in_room(Request $request)
    {
        $requestData = $request->all();

        $room_id = $requestData['room_id'];
        $room_of_members = $requestData['room_of_members'];
        $members_in_room = $requestData['members_in_room'];

        $room_data = [
            "room_id" => $room_id,
            "room_of_members" => $room_of_members,
        ];

        $dataRoomRTC = RoomRTC::where('room_id',$room_id)->where('room_of_members',$room_of_members)->first();

        $memberInData = $dataRoomRTC->members_in_room;
        $memberInData_ep = explode(",",$memberInData);

         // วนลูป แล้วเช็ค ถ้าตรงเงื่อนไขให้ไม่ต้องอัพเดทอะไร
        foreach ($memberInData_ep as $exp => $exp_value){
            if($exp_value == $members_in_room){
                // ไม่ต้องทำอะไร
            }else{
                if($dataRoomRTC->members_in_room == null){
                    $memberData = $members_in_room;
                }else{
                    $memberData = $dataRoomRTC->members_in_room . "," . $members_in_room;
                }

                $roomVideocallStats = [
                    "members_in_room" => $memberData,
                ];

                RoomRTC::updateOrCreate($room_data, $roomVideocallStats);
            }
        }

        return $members_in_room;
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

        if(empty($dataRoomRTC)){
            $requestData_RoomRTC['room_of_members'] = $room_of_members;
            $requestData_RoomRTC['room_id'] = $room_id;
            //สร้าง Member_of_room ต่อจาก Room
            RoomRTC::create($requestData_RoomRTC);
            //ค้นหาใหม่
            $dataRoomRTC = RoomRTC::where('room_id',$room_id)->where('room_of_members',$room_of_members)->first();
        }

        //เช็คจำนวนครั้ง ของ การใช้ videoCall ในห้องตาม room_id และ room_of_members
        if($dataRoomRTC->amount_meet == null){
            $newAmountMeet = 1;
        }else{
            $newAmountMeet = (int)$dataRoomRTC->amount_meet + 1;
        }

        // สำหรับใช้เช็ค current_people
        $memberInData = $dataRoomRTC->members_in_room;
        $memberInData_ep = explode(",",$memberInData);
        //นับจำนวน index ใน array ที่เหลืออยู่
        $count_ep = count($memberInData_ep);

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
            "current_people" => $count_ep,
        ];

        echo"<pre>";
        print_r($roomVideocallStats);
        echo"</pre>";


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

        $roomVideocallStats = [
            "time_start" => null,
            "current_people" => 0,
            "members_in_room" => null,
        ];

        RoomRTC::updateOrCreate($room_data, $roomVideocallStats);

        return $roomVideocallStats;
    }

    public function userLeave(Request $request)
    {
        $requestData = $request->all();

        $room_id = $requestData['room_id'];
        $room_of_members = $requestData['room_of_members'];
        $members_in_room = $requestData['members_in_room'];
        $dataRoomRTC = RoomRTC::where('room_id',$room_id)->where('room_of_members',$room_of_members)->first();

        // $room_data = [
        //     "room_id" => $room_id,
        //     "room_of_members" => $room_of_members,
        // ];

        $memberInData = $dataRoomRTC->members_in_room;

        if(!empty($memberInData)){
            $memberInData_ep = explode(",",$memberInData);

            // วนลูป แล้วเช็ค ถ้าตรงเงื่อนไขให้ลบไอดี array ตัวที่ตรงกับไอดี ของ user ที่ออกจากห้อง
            foreach ($memberInData_ep as $exp => $exp_value){
                if($exp_value == $members_in_room){
                    unset($memberInData_ep[$exp]);
                }
            }

            //นับจำนวน index ใน array ที่เหลืออยู่
            $count_ep = count($memberInData_ep);

            // นำผลของ memberInData_ep ทึ่ได้มา set ค่า
            $new_memberData = '';

            $updateDataRoomRTC = $count_ep;

            if($count_ep == 0){
                $new_memberData = null;

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

            }else{
                if($count_ep == 1){
                    $new_memberData = $memberInData_ep[0];
                }else{
                    for ($i=0; $i < $count_ep; $i++) {
                        $new_memberData = $new_memberData . "," . $memberInData_ep[$i] ;
                    }
                }
            }

            DB::table('room_rtc')
            ->where('room_id', $room_id)
            ->where('room_of_members', $room_of_members)
            ->update([
                'members_in_room' => $new_memberData,
                'current_people' => $updateDataRoomRTC,
            ]);

        }else{
            DB::table('room_rtc')
            ->where('room_id', $room_id)
            ->where('room_of_members', $room_of_members)
            ->update([
                'members_in_room' => null,
                'current_people' => 0,
                'time_start' => null,
            ]);
        }

        return $members_in_room;
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
