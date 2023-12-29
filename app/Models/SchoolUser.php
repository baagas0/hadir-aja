<?php

namespace App\Models;

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
