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
            
            $table->string('ownerHouseNo'); 
            $table->string('ownerStreetAddress'); 
            $table->string('ownerCity'); 
            $table->string('ownerEmail'); 
            $table->string('ownerPhone'); 
            $table->date('dateOfApplication'); 
            $table->string('businessName'); 
            $table->string('tinNumber'); 
            $table->string('businessNo');
            $table->string('BusStreetAddress');
            $table->string('businessCity'); 
            $table->string('businessEmail');
            $table->string('businessPhone'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};

