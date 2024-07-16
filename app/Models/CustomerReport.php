<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReport extends Model
{
    use HasFactory;
    protected $primaryKey = 'report_id';
    protected $fillable = ['customer_id', 'service_id', 'report_content'];
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
    public function serviceRequest()
{
    return $this->belongsTo(ServiceRequest::class, 'service_request_id');
}

}
