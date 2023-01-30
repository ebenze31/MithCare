<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mylog;
use Illuminate\Support\Facades\Auth;

class LineApiController extends Controller
{
    public function store(Request $request){

        //SAVE LOG
        $requestData = $request->all();
        $data = [
            "title" => "Line",
            "content" => json_encode($requestData, JSON_UNESCAPED_UNICODE),

        ];
        Mylog::create($data);
    }
}
