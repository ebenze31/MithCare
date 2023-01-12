<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Member_of_room;
use Illuminate\Http\Request;

class Member_of_roomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('member_of_room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Member_of_room::create($requestData);

        return redirect('member_of_room')->with('flash_message', 'Member_of_room added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $member_of_room = Member_of_room::findOrFail($id);

        return view('member_of_room.show', compact('member_of_room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $member_of_room = Member_of_room::findOrFail($id);

        return view('member_of_room.edit', compact('member_of_room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $member_of_room = Member_of_room::findOrFail($id);
        $member_of_room->update($requestData);

        return redirect('member_of_room')->with('flash_message', 'Member_of_room updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Member_of_room::destroy($id);

        return redirect('member_of_room')->with('flash_message', 'Member_of_room deleted!');
    }
}
