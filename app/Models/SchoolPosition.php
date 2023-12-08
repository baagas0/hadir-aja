<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'position_code',
        'position_name'
    ];
}
