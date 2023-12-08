<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'package_id',
        'price',
        'billing_code',
        'payment_duration',
        'start_date',
        'end_date',
        'status',
    ];
}
