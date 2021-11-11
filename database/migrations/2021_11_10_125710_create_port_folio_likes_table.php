<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortFolioLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('port_folio_likes', function (Blueprint $table) {
            $table->id();
            $table->string("from",10);
            $table->bigInteger("to")->unsigned();
            $table->foreign('to')->references('id')->on('user_port_folios')
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
        Schema::dropIfExists('port_folio_likes');
    }
}
