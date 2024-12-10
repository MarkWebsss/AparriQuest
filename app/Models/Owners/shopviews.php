<?php

namespace App\Models\Owners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\businesses; 
use App\Models\User;

class ShopViews extends Model
{
    protected $table = 'shopviews';

    protected $fillable = [
        'shop_id',
        'user_id',
        'viewCount',
        'viewed_at',
    ];

    // Relationship to the businesses table
    public function business()
    {
        return $this->belongsTo(businesses::class, 'shop_id');
    }

    // Relationship to the users table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
