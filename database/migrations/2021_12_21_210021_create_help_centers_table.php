<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('TID', 11);
            $table->string('Account_number', 11);
            $table->string('subject');
            $table->enum('category', ['0','1','2','3','4']);
            $table->mediumText('message');
            $table->enum('status', ['0','1','2']);  /* 0 => Open; 1 under response; 2 closed */
            $table->timestamps();
            $table->foreign('Account_number')->references('Account_number')->on('users')
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
        Schema::dropIfExists('help_centers');
    }
}
