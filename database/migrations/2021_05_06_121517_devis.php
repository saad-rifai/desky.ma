<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Devis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('OID', 15);
            $table->string('email');
            $table->string('b_email');
            $table->string('c_email');
            $table->string('c_name');
            $table->integer('c_type');
            $table->string('c_phone')->nullable();
            $table->string('c_ice',20)->nullable();
            $table->json('items');
            $table->integer('p_method')->nullable();
            $table->integer('p_condition')->nullable();
            $table->integer('status')->nullable();
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
