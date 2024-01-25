<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\TripayService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function getIndex()
    {
        return view('payment.index');
    }

    public function getPackage($package_id)
    {
        $auth = Auth::guard('web')->user();
        if($auth->school_id) {
            $payment = Payment::where('school_id', $auth->school_id)
                ->where('package_id', $package_id)
                ->where('approval_status', 0)
                ->where('expired_at', '>', now())
                ->first();
            if ($payment) return redirect('/checkout/detail/' . $payment->reference);
        }

        $package = Package::findOrFail($package_id);
        $data['package'] = $package;
        $data['groups'] = collect((new TripayService())->channel())->groupBy('group');

        return view('payment.package', $data);
    }
}
