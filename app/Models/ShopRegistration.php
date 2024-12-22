<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\businesses;

class ShopRegistration extends Model
{
    use HasFactory;

    // Add user_id to the fillable property to allow mass assignment
    protected $fillable = [
        'user_id',          // Add this line to allow user_id to be mass assigned
        'name',             // Add other columns as needed
        'email',
        'password',
        'business_name',
        'business_email',
        'business_phone',
        'tin_number',
        'status',
    ];

    // You can also define hidden fields for sensitive data, like passwords
    protected $hidden = [
        'password',
    ];
        // Optionally, define relationships with other models
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
        public function business()
        {
            return $this->belongsTo(businesses::class, 'business_id'); 
        }
    
        // Add relationship for the admin who approved the claim request
        public function approvedBy()
        {
            return $this->belongsTo(User::class, 'approved_by'); // This is the admin who approved the request
        }
        
}
