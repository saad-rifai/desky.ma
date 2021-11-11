<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPortFoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_port_folios', function (Blueprint $table) {
            $table->id();
            $table->string('Account_number', 10);
            $table->string('title', 250);
            $table->mediumText('description', 700);
            $table->json('files');
            $table->integer('sector');
            $table->integer('activite');
            $table->integer('status');
            $table->foreign('Account_number')->references('Account_number')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('user_port_folios');
    }
}
