<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID');
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('serviceID');
            $table->string('name');
            $table->string('phone');
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('serviceID')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
