<?php

namespace App\Models\Replacables;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $fillable = [
        'name',
        'description',
        'level',
        'permissions',
    ];
}
