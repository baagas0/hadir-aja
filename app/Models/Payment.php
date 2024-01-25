<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'package_id',
        'payment',
        'reference',
        'merchant_ref',
        'amount',
        'amount_received',
        'expired_at',
        'approval_status',
        'approval_at'
    ];

    protected $casts = [
        'expired_at'  => 'date:Y-m-d',
        'approval_at'  => 'date:Y-m-d',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
