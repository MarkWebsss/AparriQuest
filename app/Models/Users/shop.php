<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'description', 'logo', 'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
