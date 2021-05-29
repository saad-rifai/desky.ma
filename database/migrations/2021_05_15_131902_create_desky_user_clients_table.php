<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskyUserClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desky_user_clients', function (Blueprint $table) {
            $table->id();
            $table->string("from", 220);
            $table->string("c_email", 220);
            $table->string("c_phone", 20)->nullable();
            $table->string("c_name", 50);
            $table->integer("c_type");
            $table->string("c_ice", 20)->nullable();
            $table->longText("notes")->nullable();
            $table->json("files")->nullable();
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
        Schema::dropIfExists('desky_user_clients');
    }
}
