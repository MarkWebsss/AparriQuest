<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Owners\OwnerProduct;
use App\Models\Owners\shopviews;
use App\Models\Users\shopfeedback;

class businesses extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'fullAddress',
        'ownerHouseNo',
        'ownerStreetAddress',
        'ownerCity',
        'ownerEmail',
        'ownerPhone',
        'businessName',
        'businessNo',
        'BusStreetAddress',
        'businessCity',
        'businessEmail',
        'businessPhone',
        'status',
        'user_id',
        'latitude',   
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($business) {
            $business->fullName = self::combineFullName($business);
        });

        static::updating(function ($business) {
            $business->fullName = self::combineFullName($business);
        });
    }

    private static function combineFullName($business)
    {
        return trim($business->firstName . ' ' . ($business->middleName ?? '') . ' ' . $business->lastName);
    }

    public function products()
    {
        return $this->hasMany(OwnerProduct::class, 'business_id'); // Ensure 'business_id' is the correct foreign key
    }
    public function views()
    {
        return $this->hasMany(shopviews::class, 'user_id');
    }
    public function feedback()
    {
        return $this->hasMany(shopfeedback::class, 'business_id');
    }
}
