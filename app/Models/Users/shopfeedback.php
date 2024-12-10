<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Admin\businesses;
use App\Models\User;

class shopfeedback extends Model
{
    use HasFactory;
    protected $table = 'shopfeedback';

    protected $fillable = ['user_id', 'business_id', 'message', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(businesses::class);
    }
}
