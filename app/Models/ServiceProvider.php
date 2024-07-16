<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class ServiceProvider extends Model
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'service_provider_id';
    protected $fillable = ['service_provider_type', 'first_name', 'middle_name', 'last_name', 'business_name', 'email', 'phone_number', 'password', 'profile_picture'];
    
    protected $table = 'service_providers';

    // Implementing the Authenticatable methods
    public function getAuthIdentifierName()
    {
        return 'id'; // Assuming your primary key is 'id'
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }


    public function services(){
        return $this->hasMany(Service::class, 'service_provider_id');
    }
    public function reports(){
        return $this->hasMany(ServiceProviderReport::class,'service_provider_id');
    }
    public function blacklisted(){
        return $this->hasOne(BlacklistedServiceProvider::class,'service_provider_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'service_provider_id');
    }
}