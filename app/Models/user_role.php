<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_role extends Model
{
    use HasFactory;

    protected $table = "user_roles";
    protected $fillable = ['role_name', 'role_status', 'show_option'];
}
