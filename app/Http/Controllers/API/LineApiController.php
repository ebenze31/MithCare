<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mylog;
use Illuminate\Support\Facades\Auth;

class LineApiController extends Controller
{
    public function store(Request $request){

        //SAVE LOG
        $requestData = $request->all();
        $user_id = Auth::id();
        $data = [
            "title" => "Line",
            "user_id" => $user_id,
            "content" => json_encode($requestData, JSON_UNESCAPED_UNICODE),

        ];
        MyLog::create($data);
    }
}
