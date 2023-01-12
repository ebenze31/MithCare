<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
 
    public function index(Request $request)
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
          
            // $room = Room::where('user_id','=', $id)
            // ->latest()->paginate($perPage);
        }

        return view('room.index', compact('room','user'));
    }

   
    public function create()
    {
        return view('room.create');
    }

    public function room_join()
    {
        return view('room.join');
    }

   
    public function store(Request $request)
    {
        $data_user = Auth::user();
        $requestData = $request->all();

        $requestData['owner_id'] = $data_user->id;
        
        Room::create($requestData);

        return redirect('room')->with('flash_message', 'Room added!');
    }


    public function show($id)
    {
        $room = Room::findOrFail($id);

        return view('room.show', compact('room'));
    }

 
    public function edit($id)
    {
        $room = Room::findOrFail($id);

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

        return redirect('room')->with('flash_message', 'Room deleted!');
    }

            //////////////////////////
            //      ค้นหาบ้าน        //
            /////////////////////////


    public function room_find_index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $room = Room::where('name', 'LIKE', "%$keyword%")
                ->orWhere('pass', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $room = Room::latest()->paginate($perPage);
        }

        return view('room.room_find.room_find_index', compact('room'));
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

}
