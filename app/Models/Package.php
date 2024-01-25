<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'code',
        'name',
        'icon',
        'description',
        'one_time_attemp',
        'bundling_price',
    ];

    public function services() {
        return $this->hasMany(PackageService::class);
    }
}
