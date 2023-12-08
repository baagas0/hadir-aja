<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolShiftHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'school_shift_id',
        'day',
        'day_in',
        'hour_in',
        'hour_out',
    ];
}
