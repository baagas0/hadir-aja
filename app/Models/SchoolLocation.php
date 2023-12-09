<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SchoolLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'title',
        'address',
        'location',
        'lat',
        'long',
        'radius_distance',
    ];

    const COLUMNS = [
        'school_id',
        'title',
        'address',
        'location',
        'lat',
        'long',
        'radius_distance',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('school_id', function (Builder $builder) {
            $auth = Auth::user();
            $builder->where('school_id',  $auth->school_id);
        });
    }
}
