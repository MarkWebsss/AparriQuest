<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class businesses extends Model
{
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
        'dateOfApplication',
        'businessName',
        'tinNumber',
        'businessNo',
        'BusStreetAddress',
        'businessCity',
        'businessEmail',
        'businessPhone',
    ];

    // Automatically set fullName before creating or updating
    protected static function boot()
    {
        parent::boot();

        // When creating a new record
        static::creating(function ($business) {
            $business->fullName = self::combineFullName($business);
        });

        // When updating an existing record
        static::updating(function ($business) {
            $business->fullName = self::combineFullName($business);
        });
    }

    // Function to combine first, middle, and last names
    private static function combineFullName($business)
    {
        return trim($business->firstName . ' ' . ($business->middleName ?? '') . ' ' . $business->lastName);
    }
}
