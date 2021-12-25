<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_auth_tokens', function (Blueprint $table) {
            $table->id();
            $table->string("Account_number", 11);
            $table->string("ip_adress", 15)->nullable();
            $table->mediumText("token")->nullable();
            $table->timestamp("last_time_use")->nullable();
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
        Schema::dropIfExists('auth_tokens');
    }
}
