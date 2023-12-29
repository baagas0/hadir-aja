<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'active_billing_id',
        'school_level',
        'school_name',
        'school_address',
        'pic_name',
        'register_ref_code',
    ];
}
