<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderReport extends Model
{
    use HasFactory;
    protected $primaryKey = 'report_id';
    protected $fillable = ['service_provider_id', 'service_id', 'report_content'];
    public function provider(){
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
