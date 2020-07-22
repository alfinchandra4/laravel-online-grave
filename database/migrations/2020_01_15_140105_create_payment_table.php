<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sender')->nullable();
            $table->string('from_bank')->nullable();
            $table->string('acc_number')->nullable();
            $table->string('to_bank')->nullable();
            $table->decimal('amount', 8, 0)->nullable();
            $table->string('pathname')->nullable();
            $table->string('status')->nullable();
            // 0 waiting
            // 1 reject
            // 2 acceptable
            // 3 rebuild record

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
        Schema::dropIfExists('payment');
    }
}
