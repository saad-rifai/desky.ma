<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContantUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contant_us', function (Blueprint $table) {
            $table->id();
            $table->string("fname", 30);
            $table->string("lname", 30);
            $table->string("email", 255);
            $table->integer("category");
            $table->string("subject", 70);
            $table->text("message");
            $table->string("ip_addr", 30);
            $table->string("USER_AGENT", 300);
            $table->string("phone", 15)->nullable();
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
        Schema::dropIfExists('contant_us');
    }
}
