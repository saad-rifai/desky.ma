<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string("Account_number", 11);
            $table->string("type", 12);
            $table->string("supervisor", 11);
            $table->enum("status", ['0','1']); /* 0 => Active; 1 => blocked */
            $table->timestamps();
            $table->foreign('Account_number')->references('Account_number')->on('users')
            ->onDelete('cascade');
            $table->foreign('supervisor')->references('Account_number')->on('users');
            $table->foreign('type')->references('type')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
