<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'number',
        'role',
        'password',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'number' => 'string',
    ];

        // Role Constants
        const ADMIN = 0;
        const CUSTOMER = 1;
    
        /**
         * Check if the user is an Admin
         */
        public function isAdmin()
        {
            return $this->role === self::ADMIN;
        }
    
        /**
         * Check if the user is a Customer
         */
        public function isCustomer()
        {
            return $this->role === self::CUSTOMER;
        }
    
        /**
         * User has many rentals
         */
        public function rentals()
        {
            return $this->hasMany(Rental::class);
        }
    
}
