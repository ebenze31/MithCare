<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Ask_for_help;
use App\Models\Group_line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tambon;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\Mylog;


class Ask_for_helpController extends Controller
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
            $ask_for_help = Ask_for_help::where('name_user', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lng', 'LIKE', "%$keyword%")
                ->orWhere('province', 'LIKE', "%$keyword%")
                ->orWhere('district', 'LIKE', "%$keyword%")
                ->orWhere('sub_district', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('photo_sos', 'LIKE', "%$keyword%")
                ->orWhere('organization_helper', 'LIKE', "%$keyword%")
                ->orWhere('name_helper', 'LIKE', "%$keyword%")
                ->orWhere('help_complete', 'LIKE', "%$keyword%")
                ->orWhere('help_complete_time', 'LIKE', "%$keyword%")
                ->orWhere('score_impression', 'LIKE', "%$keyword%")
                ->orWhere('score_period', 'LIKE', "%$keyword%")
                ->orWhere('score total', 'LIKE', "%$keyword%")
                ->orWhere('commemt_help', 'LIKE', "%$keyword%")
                ->orWhere('notify', 'LIKE', "%$keyword%")
                ->orWhere('photo_succeed', 'LIKE', "%$keyword%")
                ->orWhere('photo_succeed_by', 'LIKE', "%$keyword%")
                ->orWhere('remark_helper', 'LIKE', "%$keyword%")
                ->orWhere('time_go_to_help', 'LIKE', "%$keyword%")
                ->orWhere('helper_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('partner_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $ask_for_help = Ask_for_help::latest()->paginate($perPage);
        }

        return view('ask_for_help.index', compact('ask_for_help'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        // $provinces = Tambon::select('province')->distinct()->get();
        // $amphoes = Tambon::select('amphoe')->distinct()->get();
        // $tambons = Tambon::select('tambon')->distinct()->get();

        return view('ask_for_help.create');
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

        Ask_for_help::create($requestData);



        return redirect('ask_for_help')->with('flash_message', 'Ask_for_help added!');
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
        $ask_for_help = Ask_for_help::findOrFail($id);

        return view('ask_for_help.show', compact('ask_for_help'));
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
        $ask_for_help = Ask_for_help::findOrFail($id);

        return view('ask_for_help.edit', compact('ask_for_help'));
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

        $ask_for_help = Ask_for_help::findOrFail($id);
        $ask_for_help->update($requestData);

        return redirect('ask_for_help')->with('flash_message', 'Ask_for_help updated!');
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
        Ask_for_help::destroy($id);

        return redirect('ask_for_help')->with('flash_message', 'Ask_for_help deleted!');
    }

    public function check_login(Request $request){

        if(Auth::check()){
            return redirect('ask_for_help/create');
        }else{
            return redirect('/login/line?redirectTo=ask_for_help/create');
        }

    }

    public function log_in_ask_for_help_add_photo($id_sos_map)
    {
        if(Auth::check()){
            return redirect('ask_for_help/add_photo' . '/' . $id_sos_map);
        }else{
            return redirect('login/line?redirectTo=ask_for_help/add_photo' . '/' . $id_sos_map);
        }
    }

    public function rate_help($id_sos_map)
    {
        $data_sos_map = Ask_for_help::findOrFail($id_sos_map);
        $data_users = User::findOrFail($data_sos_map->user_id);

        if (!empty($data_sos_map->score_impression)) {
            $score = "Yes" ;
        }else{
            $score = "No" ;
        }

        return view('ask_for_help.rate_help', compact('data_sos_map','data_users','score'));
    }


    public function ask_for_help_add_photo($id_sos_map)
    {
        $user = Auth::user();
        $data_sos_map = Ask_for_help::findOrFail($id_sos_map);

        if (!empty($data_sos_map->photo_succeed_by)) {
            $data_officer = User::where('id' , $data_sos_map->photo_succeed_by)->first();
        }else{
            $data_officer = "" ;
        }

        if (!empty($data_sos_map->photo_succeed)) {
            $photo_succeed = "Yes" ;
        }else{
            $photo_succeed = "No" ;
        }

        return view('ask_for_help.add_photo_succeed', compact('user' , 'data_sos_map' , 'photo_succeed' ,'data_officer'));
    }

    public function sos_thank_submit_score($user_id)
    {
        return view('ask_for_help.sos_thank_submit_score', compact('user_id'));
    }


}
