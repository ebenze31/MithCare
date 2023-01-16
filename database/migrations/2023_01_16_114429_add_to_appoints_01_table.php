<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToAppoints01Table extends Migration
{
  
    public function up()
    {
        Schema::table('appoints', function (Blueprint $table) {
            $table->date('date')->nullable();
        });
    }

   
    public function down()
    {
        Schema::table('appoints', function (Blueprint $table) {
            //
        });
    }
}
