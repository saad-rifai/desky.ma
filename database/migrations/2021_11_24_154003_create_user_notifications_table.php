<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->string("from", 11)->nullable();
            $table->string("to",11);
            $table->mediumText("message");
            $table->enum("status", ['0','1','2']); /* 0 = new; 1 = not readed; 2 = readed;   */
            $table->enum("notifybyemail", ['0','1']); /* 0 = No; 1 = Yes */
            $table->enum("email_status", ['0','1']); /*0 = waiting  send email; 1 = email Sended */
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
        Schema::dropIfExists('user_notifications');
    }
}
