<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Member_of_room;
use Illuminate\Http\Request;

class Member_of_roomController extends Controller
{
 
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $member_of_room = Member_of_room::where('status', 'LIKE', "%$keyword%")
                ->orWhere('lv_of_caretaker', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('room_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $member_of_room = Member_of_room::latest()->paginate($perPage);
        }

        return view('member_of_room.index', compact('member_of_room'));
    }

    public function create()
    {
        return view('member_of_room.create');
    }

   
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Member_of_room::create($requestData);

        return redirect('member_of_room')->with('flash_message', 'Member_of_room added!');
    }

    public function show($id)
    {
        $member_of_room = Member_of_room::findOrFail($id);

        return view('member_of_room.show', compact('member_of_room'));
    }

    
    public function edit($id)
    {
        $member_of_room = Member_of_room::findOrFail($id);

        return view('member_of_room.edit', compact('member_of_room'));
    }

   
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $member_of_room = Member_of_room::findOrFail($id);
        $member_of_room->update($requestData);

        return redirect('member_of_room')->with('flash_message', 'Member_of_room updated!');
    }

    public function destroy($id)
    {
        Member_of_room::destroy($id);

        return redirect('member_of_room')->with('flash_message', 'Member_of_room deleted!');
    }
}
