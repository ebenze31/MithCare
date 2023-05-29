<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Models\Member_of_room;
use App\Models\RoomRTC;

class RoomRTCController extends Controller
{
    public function index(Request $request)
    {
        // $id = Auth::id();
        $requestData = $request->all();
        $room_id = $requestData['room_id'];

        $keyword = $request->get('search');
        $perPage = 6;

        $RoomData = RoomRTC::where('room_id',$room_id)->get();

        if (!empty($keyword)) {
            $lobby_room = Member_of_room::where('room',$room_id)
                ->where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $lobby_room = Member_of_room::where('room_id',$room_id)->where('status','!=','patient')->latest()->paginate($perPage);
        }

        return view('room.room_rtc.room_rtc_index', compact('lobby_room','RoomData','room_id'));
    }

    public function beforeJoin(Request $request, $room_id,$user_id){
        // $requestData = $request->all();
        // $room_id = $requestData['room_id'];
        // $user_id = $requestData['user_id'];

        $RoomData = RoomRTC::where('room_id',$room_id)->where('room_of_members',$user_id)->first();

        $user_DB = User::where('id',$user_id)->first();

        return view('room.room_rtc.room_before_join', compact('user_DB','RoomData','room_id','user_id'));
    }

    public function getStatRoom(Request $request){
        $requestData = $request->all();

        $room_id = $requestData['room_id'];
        $user_id = $requestData['room_of_members'];

        $RoomStat = RoomRTC::where('room_id',$room_id)->where('room_of_members',$user_id)->first();

        return $RoomStat;
    }

    public function getMember_form_id(Request $request){
        $requestData = $request->all();

        $user_id = $requestData['user_id'];

        $Member_form_Id = User::where('id',$user_id)->first();

        return $Member_form_Id;
    }

}
