<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAdministrator extends Model
{
    use HasFactory;
    protected $primaryKey = 'admin_id';
    protected $fillable = ['email', 'password', 'admin_name'];
}
