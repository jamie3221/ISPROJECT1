<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $primaryKey = 'service_id';
    protected $fillable = ['service_name', 'service_provider_id', 'location_id', 'description', 'pictures'];
    public function provider(){
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }
    public function ratings(){
        return $this->hasMany(Rating::class,'service_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'service_id');
    }
    public function customerreports(){
        return $this->hasMany(CustomerReport::class,'service_id');
    }
    public function serviceProviderReports(){
        return $this->hasMany(ServiceProviderReport::class,'service_id');
    }
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'service_id');
    }

}
