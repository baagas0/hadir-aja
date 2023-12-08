<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'group_name',
        'group_code',
        'school_shift_id',
        'daily_presence_service_id',
        'group_role_id',
    ];
}
