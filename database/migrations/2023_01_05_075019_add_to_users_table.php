<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('nickname')->nullable();
            $table->string('full_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('photo')->nullable();
            $table->string('role')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('health_card_1')->nullable();
            $table->string('health_card_2')->nullable();
            $table->string('health_card_3')->nullable();
            $table->string('organization')->nullable();
            $table->string('sub_organization')->nullable();
            $table->string('status')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('add_line')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
