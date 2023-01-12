<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Appoint;
use Illuminate\Http\Request;

class AppointController extends Controller
{
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $appoint = Appoint::where('title', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('date_time', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('sent_round', 'LIKE', "%$keyword%")
                ->orWhere('create_by_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $appoint = Appoint::latest()->paginate($perPage);
        }

        return view('appoint.index', compact('appoint'));
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
    }

    
    public function show($id)
    {
        $appoint = Appoint::findOrFail($id);

        return view('appoint.show', compact('appoint'));
    }

  
    public function edit($id)
    {

        // if (Auth::id()  == $id){
            $room = Room::findOrFail($id);

            $appoint = Appoint::where('room_id', $id)->get();
            // echo"<pre>";
            // print_r($appoint);
            // echo"</pre>";
            // exit();
            
            return view('appoint.appoint_edit', compact('room','appoint'));

        //  }else{
        //     return view('404');
        //  }

      
    }

  
    public function update(Request $request, $id)
    {
       
        $requestData = $request->all();
        
        $appoint = Appoint::findOrFail($id);
        $appoint->update($requestData);

        return redirect()->route('appoint', ['id' => $id],'edit');
    }

    public function destroy($id)
    {
        Appoint::destroy($id);

        return redirect('appoint')->with('flash_message', 'Appoint deleted!');
    }
}
