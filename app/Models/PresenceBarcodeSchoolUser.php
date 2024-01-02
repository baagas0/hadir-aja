<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceBarcodeSchoolUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_user_id',
        'presence_barcode_id',
        'hour_in',
        'hour_out',
        'duration',
        'state',
        'status',
    ];

    const COLUMNS = [
        'school_user_id',
        'presence_barcode_id',
        'hour_in',
        'hour_out',
        'duration',
        'state',
        'status',
    ];
}
