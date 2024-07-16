<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServiceProvider extends Model implements Authenticatable
{
    // Implementing the Authenticatable methods
    public function getAuthPasswordName()
    {
        // Implement the logic to return the name of the password column in your table
        return 'password';
    }

    public function getRememberToken()
    {
        // Implement the logic to retrieve the remember token value
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        // Implement the logic to set the remember token value
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        // Implement the logic to return the name of the remember token column in your table
        return 'remember_token';
    }


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