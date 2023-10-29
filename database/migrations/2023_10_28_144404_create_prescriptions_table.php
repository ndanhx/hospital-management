<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('STT')->nullable();
            $table->string('drug_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('time')->nullable(); 
            $table->unsignedBigInteger('heath_book_id');
            $table->foreign('heath_book_id')->references('id')->on('heath_books')->onDelete('cascade');
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
        Schema::dropIfExists('prescriptions');
    }
};
