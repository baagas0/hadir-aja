<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Services\TripayService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function postStore(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'channel' => 'required',
        ]);

        $package = Package::findOrFail($request->package_id);
        $channel = (new TripayService())->channel($request->channel);
        $payment = Payment::query()
            ->where('package_id', $package->id)
            ->where('payment', $request->channel)
            ->where('approval_status', 0)
            ->where('expired_at', '>', now())
            ->first();
        $expired_at = now()->addDay();
        if (!$payment) {
            $merchant_ref = 'INV-' . auth()->user()->id . time();
            $price = $package->bundling_price + ((int) $channel[0]['total_fee']['flat']) + ((int) $channel[0]['total_fee']['percent'] * $package->bundling_price / 100);
            $tripay = (new TripayService())->request([
                'method' => $channel[0]['code'],
                'merchant_ref' => $merchant_ref,
                'amount' => $price,
                'customer_name' => auth()->user()->name,
                'customer_email' => auth()->user()->email,
                'order_items' => [
                    [
                        'sku' => $package->code,
                        'name' => $package->name,
                        'price' => $price,
                        'quantity' => 1,
                    ]
                ],
                'expired_time' => $expired_at->timestamp,
            ]);

            $payment = Payment::create([
                'user_id' => auth()->user()->id,
                'package_id' => $package->id,
                'school_id' => auth()->user()->school_id,
                'payment' => $request->channel,
                'merchant_ref' => $merchant_ref,
                'reference' => $tripay['reference'],
                'amount' => $tripay['amount'],
                'amount_received' => $tripay['amount_received'],
                'expired_at' => $expired_at->format('Y-m-d H:i:s'),
                'approval_status' => 0,
                'approval_at' => null,
            ]);
        }

        return redirect('/checkout/detail/' . $payment->reference);
    }

    public function getDetail($reference)
    {
        $payment = Payment::query()
            ->with('school', 'user', 'package', 'package.services')
            ->where('reference', $reference)
            // ->where('approval_status', 0)
            ->where('expired_at', '>', now())
            ->firstOrFail();
            // dd($payment);
        $tripay = (new TripayService())->detail($payment->reference);

        return view('checkout.invoice', compact('payment', 'tripay'));
    }
}
