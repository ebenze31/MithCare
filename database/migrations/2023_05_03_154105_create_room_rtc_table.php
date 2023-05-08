<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomRtcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_rtc', function (Blueprint $table) {
            $table->id();
            $table->string('room_id')->nullable();
            $table->string('room_name')->nullable();
            $table->string('time_start')->nullable();
            $table->string('current_people')->nullable();
            $table->string('total_timemeet')->nullable();
            $table->string('amount_meet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_rtc');
    }
}
