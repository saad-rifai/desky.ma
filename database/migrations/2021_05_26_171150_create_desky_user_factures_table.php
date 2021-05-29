<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskyUserFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desky_user_factures', function (Blueprint $table) {
            $table->id();
            $table->string('OID', 15);
            $table->string('CID', 15);
            $table->string('email');
            $table->json('items');
            $table->integer("remise");
            $table->integer('p_method')->nullable();
            $table->integer('p_condition')->nullable();
            $table->integer('status')->nullable();
            $table->longText("notes")->nullable();
            $table->string("token_share", 25);
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
        Schema::dropIfExists('desky_user_factures');
    }
}
