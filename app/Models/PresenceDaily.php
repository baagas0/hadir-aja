<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceDaily extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'school_user_id',
        'presence_location_id',
        'service_id',
        'school_shift_id',
        'school_shift_hour_id',
        'day',
        'actual_hour_in',
        'actual_hour_out',
        'actual_duration',
        'presence_date',
        'presence_day',
        'attachment_in',
        'face_match_in_response',
        'hour_in',
        'lat_in',
        'long_in',
        'attachment_out',
        'face_match_out_response',
        'hour_out',
        'lat_out',
        'long_out',
        'duration',
        'state',
        'status',
    ];

    const COLUMNS = [
        'school_id',
        'school_user_id',
        'presence_location_id',
        'service_id',
        'school_shift_id',
        'school_shift_hour_id',
        'day',
        'actual_hour_in',
        'actual_hour_out',
        'actual_duration',
        'presence_date',
        'presence_day',
        'attachment_in',
        'face_match_in_response',
        'hour_in',
        'lat_in',
        'long_in',
        'attachment_out',
        'face_match_out_response',
        'hour_out',
        'lat_out',
        'long_out',
        'duration',
        'state',
        'status',
    ];

    protected $casts = [
        'face_match_in_response' => 'array'
    ];

    public function school() {
        return $this->belongsTo(School::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function school_user() {
        return $this->belongsTo(SchoolUser::class);
    }
}
