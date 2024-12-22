<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id'); // Foreign key for owner
            $table->string('request_type'); // E.g., 'claim', 'support', etc.
            $table->text('message'); // The actual request message
            $table->enum('status', ['Pending', 'Approved', 'Denied'])->default('pending');
            $table->timestamps();
    
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_requests');
    }
};
