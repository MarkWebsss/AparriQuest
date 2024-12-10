<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
use App\Models\Users\Shop;
use App\Models\Admin\businesses;
use App\Models\Owners\OwnerProduct;
use App\Models\Users\shopfeedback;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn('name', $roles)->first() ? true : false;
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->first() ? true : false;
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function userRequest()
    {
        return $this->hasOne(UserRequest::class);
    }

    public function business(): HasOne
    {
        return $this->hasOne(businesses::class, 'user_id'); 
    }

    // Add the products relationship
    public function products(): HasMany
    {
        return $this->hasMany(OwnerProduct::class, 'user_id', 'id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(shopfeedback::class, 'user_id', 'id');
    }
}
