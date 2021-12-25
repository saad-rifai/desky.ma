<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_limits', function (Blueprint $table) {
            $table->id();
            $table->string("Account_number",11)->unique();
            $table->integer("Number_of_orders_per_month")->default(5);
            $table->integer("Number_of_offers_per_month")->default(5);
            $table->integer("Number_of_Employees_per_order")->default(5);
            $table->timestamps();
            $table->foreign('Account_number')->references('Account_number')->on('users')
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
        Schema::dropIfExists('account_limits');
    }
}
