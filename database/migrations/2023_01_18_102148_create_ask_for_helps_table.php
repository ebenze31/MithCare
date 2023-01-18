<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAskForHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_for_helps', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_user')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('address')->nullable();
            $table->string('content')->nullable();
            $table->string('photo_sos')->nullable();
            $table->string('organization_helper')->nullable();
            $table->string('name_helper')->nullable();
            $table->string('help_complete')->nullable();
            $table->dateTime('help_complete_time')->nullable();
            $table->integer('score_impression')->nullable();
            $table->integer('score_period')->nullable();
            $table->float('score total')->nullable();
            $table->string('commemt_help')->nullable();
            $table->string('notify')->nullable();
            $table->string('photo_succeed')->nullable();
            $table->string('photo_succeed_by')->nullable();
            $table->string('remark_helper')->nullable();
            $table->dateTime('time_go_to_help')->nullable();
            $table->string('helper_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('partner_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ask_for_helps');
    }
}
