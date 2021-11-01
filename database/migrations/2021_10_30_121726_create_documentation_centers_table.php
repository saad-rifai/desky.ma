<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentation_centers', function (Blueprint $table) {
            $table->id();
            $table->string('Account_number', 10)->unique();
            $table->integer('file_type'); /* 1 = cin, 2 = passport, 3 = residence card */
            $table->string("document_id", 10);
            $table->date("expiration_date");
            $table->integer('status');
            $table->json("files");
            $table->string("message", 250)->nullable();
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
        Schema::dropIfExists('documentation_centers');
    }
}
