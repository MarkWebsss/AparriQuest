<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owner_products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
        
            // Foreign key for the user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
            $table->string('image')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('status')->default('available');
        
            $table->timestamp('archived_at')->nullable();
            
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('owner_products'); // Drop the table
    }
};

