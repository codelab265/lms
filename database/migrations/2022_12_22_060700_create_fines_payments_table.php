<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->references('id')->on('users')->cascadeOnDelete();
            $table->string('book_title');
            $table->string('course')->nullable();
            $table->string('access_number');
            $table->float('amount_paid');
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
        Schema::dropIfExists('fines_payments');
    }
}