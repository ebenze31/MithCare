<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mylog;


class LineApiController extends Controller
{
    public function store(Request $request)
    {
        //SAVE LOG
        $requestData = $request->all();
        
        if($requestData){
            $data = [
                "title" => "Line",
                "content" => $requestData,
            ];
            MyLog::create($data);  
        }else{
            $data = [
                "title" => "Line",
                "content" => "hello",
            ];
            MyLog::create($data);  
        }
        

        //GET ONLY FIRST EVENT
        // $event = $requestData["events"][0];

        // switch($event["type"]){
        //     case "message" : 
        //         $this->messageHandler($event);
        //         break;
        //     case "postback" : 
        //         $this->postbackHandler($event);
        //         break;
        //     case "join" :
        //         $this->save_group_line($event);
        //         break;
        //     case "follow" :
        //         $this->user_follow_line($event);
        //         DB::table('users')
        //             ->where([ 
        //                     ['type', 'line'],
        //                     ['provider_id', $event['source']['userId']],
        //                     ['status', "active"] 
        //                 ])
        //             ->update(['add_line' => 'Yes']);
        //         break;
        // }
    }
}
