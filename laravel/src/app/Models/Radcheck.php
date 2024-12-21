<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radcheck extends Model
{
    protected $table = 'radcheck';

    protected $fillable = [
        'username',
        'attribute',
        'op',
        'value',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('radcheck.username', 'LIKE', "%$search%");
    }
}
