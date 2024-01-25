<?php

namespace App\Models;

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
            $sb = SchoolBilling::with('school', 'package', 'quotas')->find($active_billing_id);

            return $sb->end_date->diff(\Carbon\Carbon::now())->days;
            // dd($sb);
            // return $sb;
        }
    }
}
