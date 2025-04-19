<?php

namespace App\Models\Replacables;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'role_id',
    ];
}
