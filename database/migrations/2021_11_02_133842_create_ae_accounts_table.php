<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ae_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('Account_number', 10)->unique();
            $table->string('cin', 20);
            $table->string('ae_number', 20);
            $table->date('cin_date_expiration');
            $table->date('ae_join_date');
            $table->integer('sector');
            $table->string('activite', 150);
            $table->string('job_title', 50);
            $table->json('files');
            $table->integer('status'); /* 0 = pending | 1 = Activited | 2 = rejected | 3 = permanently rejected */
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
        Schema::dropIfExists('ae_accounts');
    }
}
