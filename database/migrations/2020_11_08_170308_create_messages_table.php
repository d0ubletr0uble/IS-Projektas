<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Laukai
     *
     * tekstas
     * busena
     * tipas
     * laiko zyma
     * (grupes narys)
     * (grupe)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->enum('type', ['text', 'audio', 'photo']);
            $table->enum('status', ['sent', 'read', 'deleted']);
            $table->foreignId('group_id')->constrained();
            $table->foreignId('group_member_id')->constrained();
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
        Schema::dropIfExists('messages');
    }
}
