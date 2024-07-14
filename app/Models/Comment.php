<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'comment_id';
    protected $fillable = ['customer_id', 'service_id', 'comment_content', 'upvotes', 'downvotes'];
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
