<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenazahdocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenazah_docs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('jenazah_id')->nullable();
            $table->foreign('jenazah_id')->references('id')->on('jenazah');

            $table->string('pathname');
            $table->string('status');
            // 0 = waiting
            // 1 = empty
            // 2 = approval

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
        Schema::dropIfExists('jenazah_docs');
    }
}
