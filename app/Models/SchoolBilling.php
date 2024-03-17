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
        'merchant_ref',
        'price',
        'billing_code',
        'payment_duration',
        'start_date',
        'end_date',
        'status',

        'issue_date',
        'due_date'
    ];

    protected $casts = [
        'start_date'  => 'date:Y-m-d',
        'end_date'  => 'date:Y-m-d',
        'issue_date'  => 'date:Y-m-d',
        'due_date'  => 'date:Y-m-d',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function quotas()
    {
        return $this->hasMany(SchoolBillingQuota::class);
    }
}
