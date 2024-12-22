<?php

namespace App\Models\Owners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\businesses;
use App\Models\User;

class ClaimRequest extends Model
{
    use HasFactory;

    // Specify the table name (optional, Laravel can auto-detect it based on model name)
    protected $table = 'claim_requests';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'business_id',
        'status',
        'proof_of_ownership',
        'approved_by', // Add approved_by here
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
