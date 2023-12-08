<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBillingQuotaTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'school_billing_id',
        'school_billing_quota_id',
        'service_id',
        'datetime',
        'ref_table',
        'ref_id',
    ];
}
