<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected $appends = [
        'remain_day'
    ];

    public function billing() {
        return $this->belongsTo(SchoolBilling::class, 'active_billing_id');
    }

    public function getRemainDayAttribute()
    {
        // return 4;
        $auth = Auth::guard('web')->user();
        if($auth->school_id && $auth->school->active_billing_id) {
            $active_billing_id = $auth->school->active_billing_id;
            $billing = SchoolBilling::with('school', 'package', 'quotas')->find($active_billing_id);
            // dd($billing);
            // return $billing->end_date->diff(\Carbon\Carbon::now())->days;
            // dd($billing->end_date);
            if(Carbon::now() > Carbon::parse($billing->end_date)) return 0;
            else return $billing->end_date->diff(\Carbon\Carbon::now())->days;

            // dd($billing);
            // return $billing;
        }
    }
}
