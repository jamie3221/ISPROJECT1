<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;
    protected $primaryKey = 'service_provider_id';
    protected $fillable = ['service_provider_type', 'first_name', 'middle_name', 'last_name', 'business_name', 'email', 'phone_number', 'password', 'profile_picture'];

    public function services(){
        return $this->hasMany(Service::class, 'service_provider_id');
    }
    public function reports(){
        return $this->hasMany(ServiceProviderReport::class,'service_provider_id');
    }
    public function blacklisted(){
        return $this->hasOne(BlacklistedServiceProvider::class,'service_provider_id');
    }
}