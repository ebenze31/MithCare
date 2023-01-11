<?php

namespace App\Http\Controllers;

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
                ->orWhere('user_id', 'LIKE', "%$keyword%")
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

  
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Appoint::create($requestData);

        return redirect('appoint')->with('flash_message', 'Appoint added!');
    }

    
    public function show($id)
    {
        $appoint = Appoint::findOrFail($id);

        return view('appoint.show', compact('appoint'));
    }

  
    public function edit($id)
    {
        return view('appoint.appoint_edit');
    }

  
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $appoint = Appoint::findOrFail($id);
        $appoint->update($requestData);

        return redirect('appoint')->with('flash_message', 'Appoint updated!');
    }

    public function destroy($id)
    {
        Appoint::destroy($id);

        return redirect('appoint')->with('flash_message', 'Appoint deleted!');
    }
}
