<?php

namespace App\Models\Replacables;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $fillable = [
        'name',
        'manager_id',
    ];
}
