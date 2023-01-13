<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToAppointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appoints', function (Blueprint $table) {
            $table->dropColumn('user_id'); 
            $table->string('create_by_id')->nullable();   
            $table->string('patient_id')->nullable();
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
        Schema::table('appoints', function (Blueprint $table) {
            //
        });
    }
}
