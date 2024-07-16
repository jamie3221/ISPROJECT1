<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'profile_picture',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'customer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'customer_id');
    }

    public function reports()
    {
        return $this->hasMany(CustomerReport::class, 'customer_id');
    }

    public function blacklisted()
    {
        return $this->hasOne(BlacklistedCustomer::class, 'customer_id');
    }
    public function deleteCustomer()
    {
        // Delete related records if needed
        // For example, delete ratings, comments, or other related data

        // Delete the customer record
        $this->ratings()->delete();
        $this->comments()->delete();
        $this->reports()->delete();
        $this->blacklisted()->delete();
        return $this->delete();
    }
}
