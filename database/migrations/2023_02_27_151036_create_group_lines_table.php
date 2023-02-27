<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_lines', function (Blueprint $table) {
            $table->id();
            $table->string('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->string('picture_url')->nullable();
            $table->string('owner')->nullable();
            $table->string('partner_id')->nullable();
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
        Schema::table('group_lines', function (Blueprint $table) {
            Schema::dropIfExists('group_lines');
        });
    }
}
