<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->string('claimant', 10);
            $table->string('defendant', 10);
            $table->enum("about", ['0', '1', '2']); /* 0 => about user; 1 => About Order; 2 => About Platforme */
            $table->enum("category", ['0','1','2']); /* 0 => I Dont Like This Content; 1 => this content is spam; 2 => This content violates the terms of use; 3 => other */
            $table->mediumText("description");
            $table->mediumText("from_url");
            $table->enum("status", ['0', '1', '2', '3']); /* 0 => open; 1 => pending; 2 => closed; 3 => sloved */
            $table->timestamps();
            $table->foreign('claimant')->references('Account_number')->on('users')
            ->onDelete('cascade');
            $table->foreign('defendant')->references('Account_number')->on('users')
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
        Schema::dropIfExists('user_reports');
    }
}
