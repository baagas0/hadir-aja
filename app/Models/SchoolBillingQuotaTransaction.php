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
        'school_user_id',
        'service_id',
        'datetime',
        'ref_table',
        'ref_id',
        'type',
    ];

    public function daily_presence() {
        return $this->belongsTo(PresenceDaily::class, 'ref_id');
    }
    
    public function barcode_presence() {
        return $this->belongsTo(PresenceBarcodeSchoolUser::class, 'ref_id');
    }
}
