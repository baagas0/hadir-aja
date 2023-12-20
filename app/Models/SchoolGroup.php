<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SchoolGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'group_name',
        'group_code',
        'school_shift_id',
        'daily_presence_service_id',
        'is_can_create_presence',
    ];

    const COLUMNS = [
        'school_id',
        'group_name',
        'group_code',
        'school_shift_id',
        'daily_presence_service_id',
        'is_can_create_presence',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('school_id', function (Builder $builder) {
            $auth = Auth::user();
            $builder->where('school_id',  $auth->school_id);
        });
    }

    public function school_shift()
    {
        return $this->belongsTo(SchoolShift::class);
    }

    public function daily_presence_service()
    {
        return $this->belongsTo(Service::class, 'daily_presence_service_id');
    }
}
