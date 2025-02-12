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
        'rate_limit',
        'expire',
        'byte_limit',
        'share_limit',
        'user_profile',
        'user_group'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('username','LIKE',"%$search%")->orWhere('address','LIKE',"%$search%")->orWhere('department','LIKE',"%$search%")->orWhere('phone','LIKE',"%$search%");
    }
}
