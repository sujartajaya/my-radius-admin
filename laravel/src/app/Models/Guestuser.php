<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guestuser extends Model
{
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'address',
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
        return $query->where('name', 'LIKE', "%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('username','LIKE',"%$search%")->orWhere('address','LIKE',"%$search%")->orWhere('phone','LIKE',"%$search%");
    }
}
