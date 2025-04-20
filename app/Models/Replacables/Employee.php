<?php

namespace App\Models\Replacables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'employed_at',
        'terminated_at',
        'role_id',
    ];
}
