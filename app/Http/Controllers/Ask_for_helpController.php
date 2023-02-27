<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Ask_for_help;
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

    public function sos_to_line(Request $request){

        $ask_for_help = Ask_for_help::get();

        echo count($ask_for_help);
        echo "<br>=============================================================================================================<br>";

        for($i = 0; $i < count($ask_for_help); $i++)
        {
            echo 'Name User : '.$ask_for_help[$i]['name_user'];
            echo "<br>";

            $this->send_Line_To_Group_SOS($ask_for_help[$i]);
        }

    }

    public function send_Line_To_Group_SOS($data_sos){

        $text_at = "@";
         // sendto Provider_id
         $sendto = User::where('id','=',$data_sos['user_id'])->first();
         $provider_id = $sendto->provider_id;

        $template_path = storage_path('../public/json/flex_sos_from_ask_for_help.json');
        $string_json = file_get_contents($template_path);
        // กรณีเป็นนัดหมายของผู้ป่วยlv2 ให้แสดงชื่อผู้ป่วย แทนคนสร้าง

        $string_json = str_replace("User_name",$data_sos['name_user'],$string_json);
        $string_json = str_replace("จังหวัด",$data_sos['province'],$string_json);
        $string_json = str_replace("อำเภอ",$data_sos['district'],$string_json);
        $string_json = str_replace("ตำบล",$data_sos['sub_district'],$string_json);
        $string_json = str_replace("รายละเอียดที่อยู่",$data_sos['address'],$string_json);
        $string_json = str_replace("gg_lat",$data_sos['lat'],$string_json);
        $string_json = str_replace("gg_lng",$data_sos['lng'],$string_json);
        $string_json = str_replace("gg_lat_mail",$text_at.$data_sos['lat'],$string_json);
        $string_json = str_replace("0999999999",$sendto->phone,$string_json);

        $messages = [ json_decode($string_json, true) ];
        $body = [
            "to" => $provider_id,
            "messages" => $messages,
        ];
        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/push";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "ส่งไลน์",
            "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
        ];

        Mylog::Create($data);
    }



}
