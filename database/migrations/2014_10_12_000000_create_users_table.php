<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("frist_name", 20);
            $table->string("last_name", 20);
            $table->string("phone_number",15)->unique();
            $table->string("email")->unique();
            $table->string("country", 5);
            $table->string("city", 6);
            $table->integer("gender");
            $table->integer("type");
            $table->string("avatar")->nullable();
            $table->mediumText("description")->nullable();
            $table->integer("sector")->nullable();
            $table->string("activity", 20)->nullable();
            $table->string("source", 20)->nullable();
            $table->string("password", 200);
            $table->integer("status");
            $table->string('Account_number', 10)->unique();
            $table->string("username", 25)->unique()->nullable();
            $table->ipAddress('IP_Address')->nullable();	
            $table->string('MAC_Address', 35)->nullable();	
            $table->string('OAuth_ID', 100)->nullable();	
            $table->timestamp('email_verified_at')->nullable();
            $table->string("verifiy_token", 35)->nullable();
            $table->integer("verified_account", 11)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
