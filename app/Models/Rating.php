<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $primaryKey = 'rating_id';
    protected $fillable = ['service_id', 'customer_id', 'rating'];
    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function serviceRequest()
{
    return $this->belongsTo(ServiceRequest::class, 'service_request_id');
}

}
