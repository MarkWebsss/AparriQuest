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
        Schema::create('owner_products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('user_id') // Foreign key for the user
                  ->constrained() // This will reference the id on the users table
                  ->onDelete('cascade'); // If a user is deleted, their products will be deleted as well

            $table->string('image')->nullable();
            $table->string('name'); // Name of the product
            $table->text('description')->nullable(); // Description of the product (optional)
            $table->decimal('price', 10, 2);// Price of the product (10 digits, 2 decimal places)
            $table->string('status')->default('available');
            
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_products'); // Drop the table if it exists
    }
};