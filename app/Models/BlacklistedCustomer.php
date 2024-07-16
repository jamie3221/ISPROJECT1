<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistedCustomer extends Model
{
    use HasFactory;
    protected $primaryKey = 'blacklist_id';
    protected $fillable = ['customer_id', 'email', 'phone_number', 'reason'];
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function serviceRequests()
{
    return $this->hasMany(ServiceRequest::class, 'customer_id');
}

}
