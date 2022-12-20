<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returned_books', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('reservation_id')
                ->references('id')
                ->on('reservations')
                ->cascadeOnDelete();
            $table
                ->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreignId('book_id')
                ->references('id')
                ->on('books');
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
        Schema::dropIfExists('returned_books');
    }
}
