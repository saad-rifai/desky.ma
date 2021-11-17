<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('OID', 10)->unique();
            $table->string('Account_number', 10);
            $table->string('title',200);
            $table->integer('sector')->nullable();
            $table->integer('activite')->nullable();
            $table->mediumText('description');
            $table->integer("place")->nullable();
            $table->float('budget');
            $table->integer('time');
            $table->json('files')->nullable();
            $table->string('message', 200)->nullable();
            $table->integer('status'); /* 0 = Pending; 1 = Receipt of offers; 2 = implementation phase; 3 = done; 4 = rejected; 5 = Permanently rejected */
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
        Schema::dropIfExists('orders');
    }
}
