<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SchoolShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'shift_name',
        'time_tolerance',
    ];

    const COLUMNS = [
        'school_id',
        'shift_name',
        'time_tolerance',
    ];

    protected $appends = [
        'duration'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('school_id', function (Builder $builder) {
            $auth = Auth::user();
            // $builder->where('school_id',  $auth->school_id);
            if($auth) $builder->where('school_id',  $auth->school_id);
        });
    }

    public function getDurationAttribute() {
        return 10000;
    }

    public function school_shift_hours() {
        return $this->hasMany(SchoolShiftHour::class);
    }
}
