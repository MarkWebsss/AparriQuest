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
        Schema::create('shopfeedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Customer providing feedback
            $table->unsignedBigInteger('business_id'); // Shop receiving feedback
            $table->text('message'); // Feedback message
            $table->integer('rating')->nullable(); // Optional rating out of 5
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopfeedback');
    }
};
