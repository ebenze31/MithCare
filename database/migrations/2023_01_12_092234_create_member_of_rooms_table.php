<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberOfRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_of_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('status')->nullable();
            $table->string('lv_of_caretaker')->nullable();
            $table->string('user_id')->nullable();
            $table->string('room_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member_of_rooms');
    }
}
