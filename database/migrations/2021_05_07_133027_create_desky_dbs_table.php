<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskyDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desky_dbs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string("b_email", 45);
            $table->string("b_phone", 11);
            $table->string("compte_bank_name", 25)->nullable();
            $table->string("compte_bank_rib", 40)->nullable();
            $table->string("compte_bank_username", 40)->nullable();
            $table->string('slogon',45)->nullable();
            $table->longText('description')->nullable(); /* infos user */
            $table->string("ice", 25)->nullable();
            $table->string("if", 20)->nullable();
            $table->string("tp", 20)->nullable();
            $table->string("siteweb", 50)->nullable();
            $table->integer("tva")->nullable();
            $table->string('brandcolor',15);
            $table->integer("sector")->nullable();
            $table->string("logo", 50);
            $table->string("cni", 10);
            $table->integer("model_devis");
            $table->integer("model_facture");

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
        Schema::dropIfExists('desky_dbs');
    }
}
