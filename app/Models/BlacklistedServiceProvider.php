<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistedServiceProvider extends Model
{
    use HasFactory;
    protected $primaryKey = 'blacklist_id';
    protected $fillable = ['service_provider_id', 'email', 'phone_number', 'reason'];
    public function provider(){
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
    public function serviceRequests()
{
    return $this->hasMany(ServiceRequest::class, 'service_provider_id');
}

}
