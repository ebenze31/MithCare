<?php

namespace App\Console\Commands;

use App\Models\Appoint;
use Illuminate\Console\Command;
use Carbon\Carbon;


class Send_Appoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:appoint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'แจ้งเตือนตารางนัด';

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
        $time_10 = Carbon::now()->addMinutes(10)->format('H:i:s');
        $date_now = Carbon::now()->format('Y-m-d');

        $appoint = Appoint::where('status','=',null)
        ->orWhere('status','=','sent')
        ->where('type','=','pill')
        ->where('date','=',$date_now)
        ->where('time','<=',$time_10)
        ->get();

        // return 0;
    }
}
