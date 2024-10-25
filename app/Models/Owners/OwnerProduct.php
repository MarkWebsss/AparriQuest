<?php

namespace App\Models\Owners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\businesses;
use App\Models\User;

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Ensure 'user_id' is the correct foreign key
    }
    public function business()
    {
        return $this->hasOne(businesses::class, 'user_id', 'user_id');
    }
}
