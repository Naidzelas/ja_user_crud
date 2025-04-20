<?php

namespace App\Models\Replacables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes, HasFactory;
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

    public function role():HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
