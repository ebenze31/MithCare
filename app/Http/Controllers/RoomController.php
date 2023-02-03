<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\Models\Room;
use App\Models\Member_of_room;
use Illuminate\Http\Request;

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
        // print_r($my_room);
        // echo"</pre>";
        // exit();

        if (!empty($keyword)) {
            $my_room = Member_of_room::where('user_id',$id)
                ->where('name', 'LIKE', "%$keyword%")
                ->orWhere('pass', 'LIKE', "%$keyword%")
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

        // สุ่มลิ้ง url
        for ($i=0; $i < 10; $i++) {
            $randomSite = "https:/www.mithcare.com/room/" . hash('adler32', $i);
        }

        // echo"<pre>";
        // print_r( $randomSite);
        // echo"</pre>";
        // exit();

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

        return view('room.show', compact('room','member'));
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

            //////////////////////////
            //      ค้นหาบ้าน        //
            /////////////////////////


    public function room_find_index(Request $request)
    {
        $keyword = $request->get('find_room_search');

        $find_room = Room::where('gen_id','LIKE', $keyword)
        ->orWhere('pass', 'LIKE', $keyword)
        ->first();

        // $room_id = Room::findOrFail($find_room->id);

        $this_room = Member_of_room::where('room_id',$find_room->id)->get();

        //  echo"<pre>";
        // print_r($this_room);
        // echo"</pre>";
        // exit();

        return view('room.room_find.room_find_index', compact('find_room','this_room'));
    }

    public function room_join(Request $request)
    {

        $requestData = $request->all();
        echo"<pre>";
        print_r($requestData);
        echo"</pre>";
        exit();
        $requestData['user_id'] = $requestData['owner_id'];
        $requestData['room_id'] = $item->id;

        Member_of_room::create($requestData);

        return redirect('room')->with('flash_message', 'Room deleted!');
        // return view('room.join' , compact('find_room','this_room'));
    }


    public function search_find_room(Request $request)
    {
        $search_room = $request->get('search');
        $room = Room::where('gen_id','LIKE', $search_room)
        ->orWhere('pass', 'LIKE', $search_room)
        ->get();

        return $room;
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
