<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class SystemAdministrator extends  Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'admin_id';
    protected $fillable = ['email', 'password', 'admin_name'];
}
