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
        Schema::create('shopviews', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            
            // Foreign key to the shops table
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('businesses')->onDelete('cascade');
        
            // Cumulative view count
            $table->integer('viewCount')->default(0); // Add this column
        
            // Foreign key to the users table (optional, if you want to track who viewed the shop)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
            // Timestamp for when the view occurred
            $table->timestamp('viewed_at')->useCurrent();
        
            $table->timestamps();
        });
              
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopviews');
    }
};
