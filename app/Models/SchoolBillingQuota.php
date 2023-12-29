<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolBillingQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_billing_id',
        'package_id',
        'service_id',
        'service_code',
        'user_count',
        'limit_quota',
        'used_quota',
        'remaining_quota',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
