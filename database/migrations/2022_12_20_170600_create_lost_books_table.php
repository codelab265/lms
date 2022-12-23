<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->references('id')->on('users')->cascadeOnDelete();
            $table->string('book_title');
            $table->date('date_of_lost');
            $table->string('course')->nullable();
            $table->string('access_number');
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
        Schema::dropIfExists('lost_books');
    }
}