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
        return $query->where('name', 'LIKE', "%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('username','LIKE',"%$search%")->orWhere('address','LIKE',"%$search%")->orWhere('department','LIKE',"%$search%")->orWhere('phone','LIKE',"%$search%");
    }
}
