<?php

namespace App\Models\Owners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerProduct extends Model
{
    use HasFactory;
    protected $table = 'owner_products';
    // Define the fillable fields
    protected $fillable = [
        'user_id',      // Foreign key for the user
        'image',        // Product image path
        'name',         // Product name
        'description',  // Product description
        'price',        // Product price
        'status',       // Product status (available or out of stock)
    ];
}
