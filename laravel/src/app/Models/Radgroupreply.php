<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radgroupreply extends Model
{
   protected $table = 'radgroupreply';
    
    protected $fillable = [
        'groupname',
        'attribute',
        'op',
        'value',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('radgroupreply.groupname', 'LIKE', "%$search%");
    }
}
