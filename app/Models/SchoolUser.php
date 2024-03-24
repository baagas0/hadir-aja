<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SchoolUser extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'school_id',
        'student_number',
        'student_name',
        'school_group_id',
        'school_position_id',
        'gender',
        'email',
        'phone_number',
        'birth_date',
        'selfie_img',
        'is_all_location_presence',
        'school_location_id',
        'password',
    ];

    const COLUMNS = [
        'school_id',
        'student_number',
        'student_name',
        'school_group_id',
        'school_position_id',
        'gender',
        'email',
        'phone_number',
        'birth_date',
        'selfie_img',
        'is_all_location_presence',
        'school_location_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('school_id', function (Builder $builder) {
            $auth = Auth::guard('web')->user();
            if($auth) $builder->where('school_id',  $auth->school_id);
        });

        static::created(function (SchoolUser $item) {
            $group = $item->school_group;
            $daily_presence_service = $group->daily_presence_service;
            if($daily_presence_service) {

                $school_shift = $group->school_shift;
                $school_shift_hours_collection = $school_shift->school_shift_hours;

                $carbon = Carbon::now()->locale('id');
                $carbon->settings(['formatFunction' => 'translatedFormat']);
                $day = $carbon->format('l');

                $shift_hour = $school_shift_hours_collection->where('day', $day)->first();
                $carbon_hour_in = Carbon::createFromTimeString($shift_hour->hour_in);
                $carbon_hour_out = Carbon::createFromTimeString($shift_hour->hour_out);
                $duration = $carbon_hour_out->diffInMinutes($carbon_hour_in);

                // ENTERING CREATE PRESENCE DATA
                $default = [
                    'school_id'             => $item->school_id,
                    'school_user_id'        => $item->id,
                    'presence_location_id'  => $item->is_all_location_presence ? null : $item->school_location_id,
                    'service_id'            => $daily_presence_service->id,
                    'school_shift_id'       => $group->school_shift_id,
                    'school_shift_hour_id'  => $shift_hour->id,
                    'day'                   => $shift_hour->day,
                    'actual_hour_in'        => $shift_hour->hour_in,
                    'actual_hour_out'       => $shift_hour->hour_out,
                    'actual_duration'       => $duration,
                    'presence_date'         => Carbon::now(),
                    'presence_day'          => $day,
                ];

                PresenceDaily::create($default);

            }

        });
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function school_group()
    {
        return $this->belongsTo(SchoolGroup::class);
    }

    public function school_position()
    {
        return $this->belongsTo(SchoolPosition::class);
    }

    public function school_location()
    {
        return $this->belongsTo(SchoolLocation::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
