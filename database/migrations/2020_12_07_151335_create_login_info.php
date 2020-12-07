<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_info', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('country');
            $table->text('device');
            $table->text('browser');
            $table->date('date');
            $table->text('ip');
            $table->text('os');
            $table->text('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_info');
    }
}