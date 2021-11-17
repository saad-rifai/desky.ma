<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('OID', 11);
            $table->string('Account_number', 11);
            $table->mediumText('description');
            $table->decimal('price');
            $table->integer('time');
            $table->enum('status', ['0','1','2','3'])->default(0); /* 0 = normale; 1 = selected; 2 = Work Done 3 = The deal has been cancelled */
            $table->enum('rating', ['0','1','2','3','4','5'])->nullable();
            $table->string('comment', 220)->nullable();
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
        Schema::dropIfExists('offers');
    }
}
