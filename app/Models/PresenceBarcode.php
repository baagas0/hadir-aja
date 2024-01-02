<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceBarcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'school_position_id',
        'service_id',
        'title',
        'description',
        'date',
        'day',
        'actual_hour_in',
        'actual_hour_out',
        'actual_duration',
        'qr_code',
    ];

    const COLUMNS = [
        'school_id',
        'school_position_id',
        'service_id',
        'title',
        'description',
        'date',
        'day',
        'actual_hour_in',
        'actual_hour_out',
        'actual_duration',
        'qr_code',
    ];

    public static function createQRCode()
    {
        $length = 21;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $check_order_id = PresenceBarcode::where('qr_code', '=', $randomString)->count();
        if ($check_order_id == 0) {
            return $randomString;
        } else {
            return PresenceBarcode::createQRCode();
        }
    }
}
