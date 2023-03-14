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
        $data = Appoint::where('id' , "!=" , null)->get();

        foreach ($data as $item) {
            Appoint::where('id' , $item->id)->delete();
        }
    }

}
