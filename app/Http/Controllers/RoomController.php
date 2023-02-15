<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\Models\Room;
use App\Models\Member_of_room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomController extends Controller
{

    public function index(Request $request)
    {
        $id = Auth::id();

        $keyword = $request->get('search');
        $perPage = 6;

        $user = User::findOrFail($id);

        $check_url = $request->get('check_url');
        $type = $request->get('type');
        // echo"<pre>";
        // print_r($keyword);
        // echo"</pre>";
        // exit();

        if (!empty($keyword)) {
            $my_room = Member_of_room::where('user_id',$id)
                ->where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $my_room = Member_of_room::where('user_id',$id)->latest()->paginate($perPage);


            // $room = Room::where('user_id','=', $id)
            // ->latest()->paginate($perPage);
        }

        return view('room.index', compact('user','my_room','check_url','type'));
    }


    public function create()
    {
        return view('room.create');
    }



    public function store(Request $request)
    {
        $data_user = Auth::user();
        $requestData = $request->all();
        $password_room = $request->get('pass');

        // สุ่มรหัส gen_id
        $randomSite = Str::random(8);

        // echo"<pre>";
        // print_r( $randomSite);
        // echo"</pre>";
        // exit();

        $requestData['pass'] = $password_room;
        $requestData['owner_id'] = $data_user->id;
        $requestData['gen_id'] = $randomSite;

        $room = Room::create($requestData);

        $requestData_Room['status'] = "owner";
        $requestData_Room['user_id'] = $requestData['owner_id'];
        $requestData_Room['room_id'] = $room->id;

        Member_of_room::create($requestData_Room);

        return redirect('room')->with('flash_message', 'Room added!');
    }


    public function show($id)
    {
        $room = Room::findOrFail($id);

        $member = Member_of_room::where('room_id',$id)->get();

        $amount_member = Member_of_room::where('room_id',$id)->count('id');

        $room_test = Room::get();

        $this_room = Member_of_room::where('room_id',$id)->where('status', 'patient')->get();

        return view('room.show', compact('room','member','amount_member','room_test','this_room'));
    }

    public function member_of_room_edit(Request $request)
    {
        $room_id = $request->get('room_id');

        $member = Member_of_room::where('room_id',$room_id)->where('status','member')->get();

        $patient = Member_of_room::where('room_id',$room_id)->where('status','patient')->get();

        $amount_member = Member_of_room::where('room_id',$room_id)->count('id');

        return view('room.room_member_edit', compact('member','patient','amount_member'));
    }


    public function edit($id)
    {
        $room = Room::findOrFail($id);

        if (!empty($keyword)) {
            $my_room = Member_of_room::where('user_id',$id)
                ->where('gen_id', 'LIKE', "%$keyword%")
                ->orWhere('pass', 'LIKE', "%$keyword%")
                ->get();
        }


        return view('room.edit', compact('room'));
    }


    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        if ($request->hasFile('home_pic')) {
            $requestData['home_pic'] = $request->file('home_pic')->store('uploads', 'public');
        }

        $room = Room::findOrFail($id);
        $room->update($requestData);

        return redirect('room')->with('flash_message', 'Room updated!');
    }


    public function destroy($id)
    {
        Room::destroy($id);

        // หา id เพื่อลบ
        $find_member_of_room = Member_of_room::where('room_id','=',$id)->get();
        foreach($find_member_of_room as $items){
           Member_of_room::where('id','=',$items->id)->delete();
        }


        // echo"<pre>";
        // print_r( $find_member_of_room);
        // echo"</pre>";
        // exit();


        return redirect('room')->with('flash_message', 'Room deleted!');
        // return back();
    }
            //======================//
            //      ค้นหาบ้าน        //
            //=====================//

    public function room_find_index(Request $request)
    {
        $keyword = $request->get('id_select_room');
        $password = $request->get('pass_room');

        $find_room = Room::where('id','=', $keyword)
        ->first();

        if($password != $find_room->pass){
            echo "<script>alert('รหัสผิดนะ');</script>";
            return back();
        }
        // $room_id = Room::findOrFail($find_room->id);

        $this_room = Member_of_room::where('room_id',$find_room->id)->where('status', 'patient')->where('lv_of_caretaker', '2')->where('caregiver','=',null)->get();

        // echo"<pre>";
        // print_r($keyword);
        // echo"</pre>";
        // exit();

        return view('room.room_find.room_find_index', compact('find_room','this_room'));
    }

    public function room_join(Request $request)
    {

        $requestData = $request->all();
        // id caregiver


        $status_of_room = $request->get('status_of_room');
        $select_takecare = $request->get('select_takecare');
        $lv_of_caretaker = $request->get('lv_of_caretaker');

        // echo"<pre>";
        // print_r($select_takecare);
        // echo"</pre>";
        // exit();

        $requestData['status'] = $status_of_room;
        $requestData['lv_of_caretaker'] = $lv_of_caretaker;
        $requestData['member_takecare'] = $select_takecare;



        $S = Member_of_room::firstOrNew(array('user_id' => $requestData['user_id']));
        $S->fill($requestData)->save();

        if($requestData['status'] == "member"){
            $member_takecare = $requestData['member_takecare'];
            $member_takecare_ep = explode(",",$member_takecare);
            $count_ep = count($member_takecare_ep);


            for ($i=0; $i < $count_ep; $i++) {
                DB::table('member_of_rooms')
                ->where('user_id', $member_takecare_ep[$i])
                ->update([
                    'caregiver' => $requestData['user_id'],
                ]);
            }
        }

        return redirect('room'.'/'.$requestData['room_id'])->with('flash_message', 'Room deleted!');
        // return view('room.join' , compact('find_room','this_room'));
    }


    public function search_find_room(Request $request)
    {

        $user_id = Auth::id();
        $search_room = $request->get('search');


        $room = Room::join('users','rooms.owner_id', '=', 'users.id')
        ->join('member_of_rooms','rooms.id','=','member_of_rooms.room_id')
        ->select('rooms.*','member_of_rooms.user_id','users.name as name_owner','users.full_name as full_name_owner')
        ->where('rooms.gen_id','=', $search_room)
        ->orWhere('rooms.name','LIKE', "%$search_room%")
        ->get();

        $room = $room->makeHidden(['pass']);

        // foreach($room as $key){
        //     if($key['user_id'] == $user_id){
        //         $key['check_user'] = 'joined';

        //         return $room;
        //     }else{
        //         $room['check_user'] = 'bor_joined';
        //         return $room;
        //     }
        // }

        return $room;

        // if($room->id == $user_id){
        //     $check = 'no';
        // }else{
        //     $check = 'yes';
        // }

        // echo"<pre>";
        // print_r($deer);
        // echo"</pre>";
        // exit();

        // $member = Member_of_room::where('room_id',$room->id)->get();



    }

    public function password_of_room(Request $request){
        $password = $request->get('password');
        $id = $request->get('id');

        $room_pass = Room::where('id',$id)
        ->where('pass',$password)
        ->first();

        $check = "";

        if(empty($room_pass->id)){
            $check = 'no';
        }else{
            $check = 'yes';
        }

        return $check;
    }

            //////////////////////////
            //    ห้องสำหรับแอดมิน    //
            /////////////////////////


    public function room_admin_index(Request $request)
    {
        $id = Auth::id();

        $keyword = $request->get('search');
        $perPage = 5;

        $user = User::findOrFail($id);

        if (!empty($keyword)) {
            $room = Room::where('name', 'LIKE', "%$keyword%")
            ->orWhere('pass', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);

        } else {
            $room = Room::latest()->paginate($perPage);
        }

        return view('room.room_admin.room_admin_index', compact('room','user'));
    }

    public function check_login(Request $request){

        $type = $request->get('type');

        if(Auth::check()){
            return redirect('room?type=' . $type);
        }else{
            return redirect('/login/line?redirectTo=room?type=' . $type);
        }

    }

}
