<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_systems', function (Blueprint $table) {
            $table->id();
            $table->integer("room_id")->nullable();
            $table->enum("type", ['0','1'])->default(0); /* 0 => Chat Normal; 1 => Chat inside a project */
            $table->string("OID", 11)->nullable();
            $table->string("from", 11);
            $table->string("to", 11);
            $table->mediumText("message");
            $table->enum("status", ['0','1', '2'])->default(0); /* 0 => new; 1 => not readed; 2 =readed; */
            $table->timestamps();
            $table->foreign('from')->references('Account_number')->on('users')
            ->onDelete('cascade');
            $table->foreign('to')->references('Account_number')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_systems');
    }
}
