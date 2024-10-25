<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
        
            // Original fields
            $table->string('firstName');
            $table->string('middleName')->nullable(); 
            $table->string('lastName'); 
            
            // Full name field
            $table->string('fullName')->nullable(); 
            $table->string('fullAddress'); 
            
            // Owner details
            $table->string('ownerHouseNo'); 
            $table->string('ownerStreetAddress'); 
            $table->string('ownerCity'); 
            $table->string('ownerEmail'); 
            $table->string('ownerPhone'); 
            $table->date('dateOfApplication'); 
            
            // Business details
            $table->string('businessName'); 
            $table->string('tinNumber'); 
            $table->string('businessNo');
            $table->string('BusStreetAddress');
            $table->string('businessCity'); 
            $table->string('businessEmail');
            $table->string('businessPhone'); 
            $table->string('status')->default('Unclaimed');

            // Coordinates (new fields)
            $table->decimal('latitude', 10, 8)->nullable();   // Latitude column with precision
            $table->decimal('longitude', 11, 8)->nullable();  // Longitude column with precision

            // Foreign key to users table
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable since businesses are unclaimed initially
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
