<?php

namespace App\Console\Commands;

use App\Models\Appoint;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Member_of_room;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;
use App\Models\Mylog;
use Illuminate\Support\Facades\DB;


class Test_delete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:test_delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ทดสอบ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data_Appoint = Appoint::where('id' , "!=" , null)->get();

        foreach ($data_Appoint as $item) {
            Appoint::where('id' , $item->id)->delete();

            $data_user  = User::where('id' , $item->patient_id)->first();
            $provider_id = $data_user->provider_id ;

            $template_path = storage_path('../public/json/text.json');
            $string_json = file_get_contents($template_path);

            $string_json = str_replace("hello","ผมได้ตรวจสอบแล้ว พบว่าคุณมันรั่วผมเลยลบข้อมูลนัดหมายของคุณ",$string_json);

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
                "content" => "$provider_id",
            ];

            Mylog::Create($data);
        }
    }

}
