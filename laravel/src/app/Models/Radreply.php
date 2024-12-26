<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radreply extends Model
{
    protected $table = 'radreply';
    
    protected $fillable = [
        'username',
        'attribute',
        'op',
        'value',
    ];
}
