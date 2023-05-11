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

        return view('room.room_rtc.room_rtc_index', compact('lobby_room','RoomData'));
    }

}
