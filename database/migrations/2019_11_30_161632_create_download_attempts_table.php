<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token', 50)->nullable();
            $table->string('ip', 30)->nullable();
            $table->string('locale', 2)->nullable();
            $table->string('user_agent', 300)->nullable();
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
        Schema::dropIfExists('download_attempts');
    }
}
