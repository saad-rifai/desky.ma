<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPrivacy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_privacy', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("UID" , 20);
            $table->integer("publice_account")->default(0);
            $table->integer("publice_devis")->default(0);
            $table->integer("publice_facture")->default(0);
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
        //
    }
}
