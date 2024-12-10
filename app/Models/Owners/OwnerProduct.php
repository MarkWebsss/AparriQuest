<?php
namespace App\Models\Owners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\businesses; // Correct namespace for Businesses model
use App\Models\User;

class OwnerProduct extends Model
{
    use HasFactory;

    protected $table = 'owner_products';

    protected $fillable = [
        'user_id',      
        'business_id',  
        'image',        
        'name',         
        'description',  
        'price',       
        'status',       
        'archived_at',  
    ];

    protected $casts = [
        'archived_at' => 'datetime',  
    ];
    
    public function scopeNotArchived($query)
    {
        return $query->whereNull('archived_at');  // Filters out products that are archived
    }
    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    // Relationship to the Business model
    public function business()
    {
        return $this->belongsTo(businesses::class, 'business_id');
    }
}
