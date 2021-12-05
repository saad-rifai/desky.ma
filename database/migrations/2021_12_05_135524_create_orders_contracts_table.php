<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('OID', 11);
            $table->string('order_owner', 11);
            $table->string('self_contracter', 11);
            $table->decimal('price');
            $table->integer('time');
            $table->enum('status', ['0','1','2', '3'])->default('0'); /* 0 => Open; 1 => done; 2 => dispute; 3 => canceled */
            $table->date('canceled_at')->nullable();
            $table->timestamps();
            $table->foreign('order_owner')->references('Account_number')->on('users')
            ->onDelete('cascade');
            $table->foreign('self_contracter')->references('Account_number')->on('users')
            ->onDelete('cascade');
            $table->foreign('OID')->references('OID')->on('orders')
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
        Schema::dropIfExists('orders_contracts');
    }
}
