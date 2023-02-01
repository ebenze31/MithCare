<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Member_of_room;

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

            return view('appoint.appoint_index', compact('room','room_id','appoint'));

        }else{
            return view('404');
        }

    }


    public function create()
    {
        return view('appoint.create');
    }

    public function store(Request $request, $id)
    {
        $create_by_id = Auth::id();

        $requestData = $request->all();
        $requestData["create_by_id"] = $create_by_id;
        $requestData["room_id"] = $id;

        Appoint::create($requestData);

        return back();
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

        // echo"<pre>";
        // print_r($requestData);
        // echo"</pre>";
        // exit();

        if($requestData['type'] == 'pill'){
            $requestData['date_time'] = null;
        }

        $appoint = Appoint::findOrFail($requestData['appoint_id']);
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
