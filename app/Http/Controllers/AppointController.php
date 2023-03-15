<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Member_of_room;
use Carbon\Carbon;
use App\Models\Appoint;
use Illuminate\Http\Request;

class AppointController extends Controller
{

    public function index(Request $request)
    {
        $room_id = $request->get('room_id');
        $type = $request->get('type');
        $user_id = Auth::id();
        $check = "" ;


        // ===================
        // TEST APPOINT NOTI
        // ===================

        $time_10 = Carbon::now()->addMinutes(10)->format('H:i:s');
        $date_now = Carbon::now()->format('Y-m-d');

        $ap_pill_test = Appoint::where('room_id','=',$room_id)
        ->where('type','=','pill')
        ->where('date','=',$date_now)
        ->where('date_time','<=',$time_10)
        ->where('status','=',null)
        ->orWhere('status','=','sent')
        ->get();

         // ใช้เช็ค status ตอนกดสร้าง นัดหมายว่าเป็นใคร
        $check_status_member = Member_of_room::where('user_id' , $user_id)->where('room_id' , $room_id)->first();

        // ใช้สำหรับ owner ทำให้สามารถนัดหมายให้ทุกคน
        $all_member_of_room = Member_of_room::where('room_id',$room_id)
        ->where('status', '!=', 'owner')
        ->get();

         // ดึงข้อมูลผู้ป่วย ที่มีคนดูแล จาก room_id ที่ได้รับ ส่งคืนไปยังหน้า appoint.blade
        $patient_with_caregiver = Member_of_room::where('room_id',$room_id)
         ->where('status', 'patient')
         ->where('caregiver','=',$user_id)
         ->get();

        // คนที่กำลังเข้าหน้าตารางนัดอยู่เป็นสมาชิกบ้านรึเปล่า
        $Member_of_room = Member_of_room::select('user_id')->where('room_id' , $room_id)->get();

        foreach ($Member_of_room as $key ) {
            if ($key->user_id == $user_id) {
                $check = "Yes" ;
            }
        }

        if ($check == "Yes"){
            $room = Room::where('id',$room_id)->first();

            if(!empty($type)){
                $appoint = Appoint::where('room_id', $room_id)->where('type' , $type)->get();
            }else{
                $appoint = Appoint::where('room_id', $room_id)->get();

            }

            return view('appoint.appoint_index',

            compact('room',
            'room_id',
            'appoint',
            'type',
            'check_status_member',
            'patient_with_caregiver',
            'all_member_of_room',
            'ap_pill_test',
            'date_now',
            'time_10',
            ));

        }else{
            return view('404');
        }

    }


    public function create()
    {
        return view('appoint.create');
    }

    public function get_data_member_of_this_room($room_id)
    {
        // ดึงข้อมูลผู้ป่วย จาก room_id ที่ได้รับ ส่งคืนไปยังหน้า appoint.blade
        $patient_this_room = Member_of_room::where('room_id',$room_id)->where('status', 'patient')->get();

        return $patient_this_room;
    }

    public function store(Request $request, $id)
    {
        $create_by_id = Auth::id();
        $user_id = $request->get('patient_id');

        // $requestData = $request->all();

        // Appoint::create($requestData);

        // return back();

        // กรณีเลือกสร้างนัดหมายให้คนอื่น -> ได้ user_id คนที่จะนัดหมายให้
        if(!empty($user_id)){
            $requestData = $request->all();
            $requestData["create_by_id"] = $create_by_id;
            $requestData["room_id"] = $id;
            $requestData['patient_id'] = $user_id;

            Appoint::create($requestData);

            return back();
        }
        // กรณีเลือกสร้างนัดหมายให้ตัวเอง -> ได้ user_id คนที่จะนัดหมายให้
        else{
            $requestData = $request->all();
            $requestData["create_by_id"] = $create_by_id;
            $requestData["room_id"] = $id;
            $requestData['patient_id'] = $create_by_id;

            Appoint::create($requestData);

            return back();
        }

        // return view('appoint');
    }


    public function show($id)
    {
        $appoint = Appoint::findOrFail($id);

        return view('appoint.show', compact('appoint'));
    }


    public function edit($id)
    {

        // if (Auth::id()  == $id){
            // $room = Room::findOrFail($id);

            // $appoint = Appoint::where('room_id', $id)->get();
            // // echo"<pre>";
            // // print_r($appoint);
            // // echo"</pre>";
            // // exit();

            // return view('appoint.appoint_edit', compact('room','appoint'));

        //  }else{
        //     return view('404');
        //  }


    }


    public function update(Request $request)
    {

        $requestData = $request->all();
        $patient_id_edit = $request->get('patient_id_edit');
        $appoint = Appoint::findOrFail($requestData['appoint_id']);

        //ถ้าค่าที่รับว่าง ให้ใช้ type ใน db
        if(empty($requestData['type'])){
            $requestData['type'] = $appoint->type;
        }
        //ถ้า type เป็น doc -> date_time เป็นค่าว่าง
        if($requestData['type'] == 'doc'){
            $requestData['date_time'] = null;
        }
        //รับid จาก radio แก้ไข appoint
        if(!empty($patient_id_edit)){
            $requestData['patient_id'] = $patient_id_edit;
        }

        $appoint->update($requestData);

        return back();

        // return redirect()->route('appoint', ['id' => $id],'edit');
    }

    public function destroy($id)
    {

        Appoint::destroy($id);

        return back();
    }

    public function get_data_appoint($appoint_id)
    {
        $data = Appoint::where('id' , $appoint_id)->first();
        return $data ;

    }
}
