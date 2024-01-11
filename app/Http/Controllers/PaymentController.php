<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Services\TripayService;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function getIndex()
    {
        return view('payment.index');
    }

    public function getPackage($package_id)
    {
        $package = Package::findOrFail($package_id);
        $data['package'] = $package;
        $data['groups'] = collect((new TripayService())->channel())->groupBy('group');

        return view('payment.package', $data);
    }
}
