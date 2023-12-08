<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'shift_name',
        'time_tolerance',
    ];
}
