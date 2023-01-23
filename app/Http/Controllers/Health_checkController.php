<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\Models\Health_check;
use Illuminate\Http\Request;

class Health_checkController extends Controller
{

    public function index(Request $request)
    {
        $id = Auth::id();

        $keyword = $request->get('search');
        $perPage = 10;

        $user = User::findOrFail($id);

        if (!empty($keyword)) {
            $health_check = Health_check::where('title', 'LIKE', "%$keyword%")
                ->orWhere('img_1', 'LIKE', "%$keyword%")
                ->orWhere('img_2', 'LIKE', "%$keyword%")
                ->orWhere('img_3', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $health_check = Health_check::latest()->paginate($perPage);
        }

        return view('health_check.index', compact('health_check','user'));
    }


    public function create()
    {
        return view('health_check.create');
    }


    public function store(Request $request)
    {

        $user_id = Auth::id();

        $requestData = $request->all();


        if ($request->hasFile('img_1')) {
            $requestData['img_1'] = $request->file('img_1')->store('uploads', 'public');
        }
        if ($request->hasFile('img_2')) {
            $requestData['img_2'] = $request->file('img_2')->store('uploads', 'public');
        }
        if ($request->hasFile('img_3')) {
            $requestData['img_3'] = $request->file('img_3')->store('uploads', 'public');
        }

        $requestData['user_id'] = $user_id;
        Health_check::create($requestData);

        return redirect('health_check')->with('flash_message', 'Health_check added!');
    }


    public function show($id)
    {
        $health_check = Health_check::findOrFail($id);

        return view('health_check.show', compact('health_check'));
    }


    public function edit($id)
    {
        $health_check = Health_check::findOrFail($id);

        return view('health_check.edit', compact('health_check'));
    }


    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $health_check = Health_check::findOrFail($id);

        if ($request->hasFile('img_1')) {
            $requestData['img_1'] = $request->file('img_1')->store('uploads', 'public');
        }
        if ($request->hasFile('img_2')) {
            $requestData['img_2'] = $request->file('img_2')->store('uploads', 'public');
        }
        if ($request->hasFile('img_3')) {
            $requestData['img_3'] = $request->file('img_3')->store('uploads', 'public');
        }

        $health_check->update($requestData);

        return redirect('health_check')->with('flash_message', 'Health_check updated!');
    }


    public function destroy($id)
    {
        Health_check::destroy($id);

        return redirect('health_check')->with('flash_message', 'Health_check deleted!');
    }
}
