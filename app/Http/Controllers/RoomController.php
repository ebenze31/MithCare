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
        $login_id = Auth::id();

        //ดึงข้อมูล สมาชิกทั้งหมด จาก id ห้องที่ได้มา
        $member = Member_of_room::where('room_id',$id)->get();

        //นับจำนวนสมาชิกในห้อง
        $amount_member = Member_of_room::where('room_id',$id)->count('id');

        //ดึงข้อมูล สมาชิกที่มีสถานะ(ผู้ป่วย)ทั้งหมด จาก id ห้องที่ได้มา
        $this_room = Member_of_room::where('room_id',$id)->where('status', 'patient')->get();

         //ดึงข้อมูล สมาชิกที่มีสถานะ(ผู้ป่วย)ทั้งหมด จาก id ห้องที่ได้มา
        $member_room = Member_of_room::where('room_id',$id)->where('status', 'member')->get();

        //หา เจ้าของห้อง
        $find_owner = Member_of_room::where('room_id',$id)->where('status', 'owner')->first();

         //หา สมาชิกจากไอดีที่เข้าสู่ระบบมา
        $member_from_login = Member_of_room::where('room_id',$id)->where('user_id', $login_id)->first();

        return view('room.show', compact('room','member','amount_member','this_room','find_owner','member_room','member_from_login'));
    }

    public function member_of_room_edit(Request $request,$id)
    {
        $requestData = $request->all();
        $data_member_of_room = Member_of_room::where('id',$id)->first();
        // $data_member_all_of_room = Member_of_room::where('room_id',$data_member_of_room->room_id)->get();

        $status =  $requestData['status_of_room'];

        $requestData['member_takecare'] = $requestData['select_takecare'];
        $sub_caregiver = $requestData['select_member_takecare'];

        // echo"<pre>";
        // print_r($requestData);
        // echo"</pre>";
        // exit();

        // เปลี่ยนเป็นสมาชิก
        if($status == "member"){

            $requestData['lv_of_caretaker'] = null;

            $member_takecare = $requestData['member_takecare'];
            $member_takecare_ep = explode(",",$member_takecare);
            $count_ep = count($member_takecare_ep);

            // $caregiver_ep = explode(",",$caregiver);
            // $count_caregiver_ep = count($caregiver_ep);

            // echo "count_caregiver_ep :".$count_caregiver_ep ;
            // echo"<br>";

            // for ($i=0; $i < $count_caregiver_ep; $i++) {

            //     echo"<=========== " . "FOR OF >> " . $caregiver_ep[$i] . " ===========>";
            //     echo"<br>";
            //     echo"<br>";

            //     // DB::table('member_of_rooms')
            //     //     ->where('user_id', $caregiver_ep[$i])
            //     //     ->where('room_id', $data_member_of_room->room_id)
            //     //     ->update([
            //     //         'member_takecare' => $requestData['member_takecare'],
            //     // ]);

            //     // // ตรวจว่า สมาชิก เคย เคยเป็นผู้ป่วยของใครมาก่อน แล้วลบออก
            //     // $caregiver_member_list = DB::table('member_of_rooms')
            //     // ->where('room_id', $data_member_of_room->room_id)
            //     // ->where('caregiver','!=',null)
            //     // // ->where('user_id','!=',$requestData['user_id'])
            //     // ->get();

            //     // foreach($caregiver_member_list as $key_caregiver => $value_caregiver){
            //     //     $exp_of_caregiver = explode(",",$value_caregiver->caregiver);

            //     //     foreach ($exp_of_caregiver as $exp_caregiver => $exp_value_caregiver){

            //     //         if($exp_value_caregiver == $caregiver_ep[$i]){
            //     //             unset($exp_of_caregiver[$exp_caregiver]);
            //     //         }

            //     //         if($exp_value_caregiver == $requestData['user_id'] ){
            //     //             unset($exp_of_caregiver[$exp_caregiver]);
            //     //         }

            //     //     }

            //     //     $new_caregiver = null;

            //     //     if($exp_of_caregiver){
            //     //         foreach ($exp_of_caregiver as $exp_update_caregiver => $exp_value_update_caregiver){
            //     //             if($new_caregiver == null){
            //     //                 $new_caregiver = $exp_value_update_caregiver ;
            //     //             }else{
            //     //                 $new_caregiver = $new_caregiver . "," . $exp_value_update_caregiver ;
            //     //             }
            //     //         }
            //     //         $new_caregiver = $requestData['user_id'] . "," . $new_caregiver;
            //     //     }



            //     // }
            // }

            // exit();

            for ($i=0; $i < $count_ep; $i++) {

                DB::table('member_of_rooms')
                ->where('user_id', $member_takecare_ep[$i])
                ->update([
                    'sub_caregiver' => $sub_caregiver,
                ]);

                DB::table('member_of_rooms')
                ->where('user_id', $member_takecare_ep[$i])
                ->update([
                    'caregiver' => $requestData['user_id'],
                ]);

                DB::table('member_of_rooms')
                ->where('user_id', $requestData['user_id'])
                ->update([
                    'caregiver' => null,
                ]);

                // ตรวจว่า สมาชิก เคย เคยเป็นผู้ป่วยของใครมาก่อน แล้วลบออก
                $deer = DB::table('member_of_rooms')
                ->where('room_id', $data_member_of_room->room_id)
                ->where('member_takecare','!=',null)
                // ->where('user_id','!=',$requestData['user_id'])
                ->get();

                foreach($deer as $key => $value){

                    // echo "เจอที่ User ID >> " . $value->user_id ;
                    // echo "<br>" ;

                    // echo "member_takecare >>  " . $value->member_takecare ;
                    // echo "<br>" ;
                    // echo "<br>" ;

                    // echo "ต้องการลบ  >>  " . $member_takecare_ep[$i] ;
                    // echo "<br>" ;
                    // echo "<br>" ;

                    $exp_of_member_takecare = explode(",",$value->member_takecare);
                    // $count_exp_of_member_takecare = count($exp_of_member_takecare);

                    // echo"Array ก่อนลบ";
                    // echo"<pre>";
                    // print_r($exp_of_member_takecare);
                    // echo"</pre>";

                    foreach ($exp_of_member_takecare as $exp => $exp_value){

                        if($exp_value == $member_takecare_ep[$i]){
                            echo $exp . " // " . $exp_value ;
                            echo "<br>" ;
                            unset($exp_of_member_takecare[$exp]);
                        }

                        if($exp_value == $requestData['user_id'] ){
                            unset($exp_of_member_takecare[$exp]);
                        }

                    }

                    // echo"Array หลังลบ";
                    // echo"<pre>";
                    // print_r($exp_of_member_takecare);
                    // echo"</pre>";

                    $new_member_takecare = null;

                    if($exp_of_member_takecare){
                        foreach ($exp_of_member_takecare as $exp_update => $exp_value_update){
                            if($new_member_takecare == null){
                                $new_member_takecare = $exp_value_update ;
                            }else{
                                $new_member_takecare = $new_member_takecare . "," . $exp_value_update ;
                            }
                        }
                    }

                    DB::table('member_of_rooms')
                        ->where('user_id', $value->user_id)
                        ->where('room_id', $data_member_of_room->room_id)
                        ->update([
                            'member_takecare' => $new_member_takecare,
                        ]);
                }

                // echo"<br>";
                // echo"<========= " . "END FOR OF >> " . $member_takecare_ep[$i] . " =========>";
                // echo"<br>";echo"<br>";echo"<br>";

            }



        }

        if($status == "patient"){

            $member_to_patient = DB::table('member_of_rooms')
            ->where('room_id', $data_member_of_room->room_id)
            ->where('user_id', $data_member_of_room->user_id)
            ->first();

            $member_to_patient_exp = explode(",",$member_to_patient->member_takecare);
            $count_exp = count($member_to_patient_exp);

            for ($i=0; $i < $count_exp; $i++) {

                DB::table('member_of_rooms')
                ->where('room_id', $data_member_of_room->room_id)
                ->where('user_id', $member_to_patient_exp[$i])
                ->update([
                    'caregiver' => null,
                ]);

            }

            DB::table('member_of_rooms')
            ->where('room_id', $data_member_of_room->room_id)
            ->where('user_id', $data_member_of_room->user_id)
            ->update([
                'member_takecare' => null,
            ]);

        }

        // exit();

        $requestData['status'] = $status;
        $member_of_room = Member_of_room::findOrFail($id);
        $member_of_room->update($requestData);

        // exit();

        return back();
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

    public function edit_member($id)
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

    public function get_data_member_of_this_room(Request $request,$room_id)
    {
        $requestData = $request->all();

        //ค้นหา caregiver คนใหม่ เพื่อนำชื่อมาใช้

        $user_id_of_new_caregiver = Member_of_room::where('room_id',$room_id)->where('user_id',$requestData['user_id'])->first();

        $select_takecare = $requestData['select_takecare'];
        $select_member_takecare = $requestData['select_member_takecare'];
        $data_have_caregive = array();
        // $assist_arr = array();
        $arr = array();
        // $data_select_member_takecare_explode = explode(",",$select_member_takecare);
        $data_member_explode = explode(",",$select_takecare);

        // for ($i=0; $i < count($data_select_member_takecare_explode); $i++) {
        //     $assistant = Member_of_room::where('room_id',$room_id)->where('user_id',$data_select_member_takecare_explode[$i])->first();
        //     $assistant_name = $assistant->user->name;

        // }

        // exit();

        for ($i=0; $i < count($data_member_explode); $i++) {
              // ดึงข้อมูลสมาชิก จาก user_id ที่ได้รับ เพื่อนำมาตรวจสอบว่ามีผู้ดูแลอยู่แล้วรึป่าว -> ส่งคืนไปยังหน้า room.edit_member.blade
            $member_this_room = Member_of_room::where('room_id',$room_id)->where('user_id',$data_member_explode[$i])->first();

            if(!empty($member_this_room->caregiver)){
                $arr['name_patient'] = $member_this_room->user->name;
                $arr['patient_id'] = $member_this_room->user_id;
                $arr['caregiver_id'] = $member_this_room->caregiver;
                $arr['caregiver_name'] = $member_this_room->user_caregiver->name;
                $arr['caregiver_new'] = $user_id_of_new_caregiver->user->name;
                // $arr['assistant_name'] = $select_member_takecare;
                array_push($data_have_caregive,$arr);
            }

        }

        return $data_have_caregive;
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

        return $room;

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
