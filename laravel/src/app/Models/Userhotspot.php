<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userhotspot extends Model
{
   protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'address',
        'department',
        'phone',
        'time_limit',
        'time_over'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%")->orWhere('email',"%$search%")->orWhere('username',"%$search%")->orWhere('address',"%$search%")->orWhere('department',"%$search%")->orWhere('phone',"%$search%");
    }
}
