<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_systems', function (Blueprint $table) {
            $table->id();
            $table->string("OID");
            $table->string("buyer_email");
            $table->string("transaction_id");
            $table->integer("amount");
            $table->integer("status");
            $table->integer("object");
            $table->string("code", 30)->nullable();
            $table->string("id_addr");
            $table->string("coupon_code", 30)->nullable();
            $table->text("device");
            $table->integer("method");
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
        Schema::dropIfExists('payment_systems');
    }
}
