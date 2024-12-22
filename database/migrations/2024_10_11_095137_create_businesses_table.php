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
            
            // Business details
            $table->integer('tin_number')->nullable()->unique();
            $table->string('businessName'); 
            $table->integer('view_count')->default(0);
            $table->string('businessNo');
            $table->string('BusStreetAddress');
            $table->string('businessCity'); 
            $table->string('businessEmail');
            $table->string('businessPhone'); 
            $table->string('status')->default('Unclaimed');

            // Coordinates
            $table->decimal('latitude', 10, 8)->nullable();   
            $table->decimal('longitude', 11, 8)->nullable();  

            // Foreign key to users table
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Timestamps (created_at and updated_at)
            $table->timestamps();
            $table->string('shopLogo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};

