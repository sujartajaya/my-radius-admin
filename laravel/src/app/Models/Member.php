<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'first_nama',
        'last_name',
        'email',
        'username',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'phone',
        'member_id',
        'status',
        'valid_date',
    ];
}