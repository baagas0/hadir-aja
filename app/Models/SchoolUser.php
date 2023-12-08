<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'student_number',
        'student_name',
        'school_group_id',
        'school_position_id',
        'gender',
        'email',
        'phone_number',
        'birth_date',
        'selfie_img',
        'is_all_location_presence',
        'school_location_id',
    ];
}
