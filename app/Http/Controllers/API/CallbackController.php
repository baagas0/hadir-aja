<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\School;
use App\Models\SchoolBilling;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function postCallback(Request $request)
    {
        $data = file_get_contents("php://input");
		$callbackSignature = $request->header('X-Callback-Signature') ?? '';
		$signature = hash_hmac('sha256', $data, config('services.tripay.private'));

		if( $callbackSignature !== $signature ) {
			// exit("Invalid Signature");
		}

		$event = $request->header('X_CALLBACK_EVENT');

		if( $event == 'payment_status' )
		{
			if( $request->status == 'PAID' )
			{
                // Get Info
                $merchant_ref = $request->merchant_ref;
                $status = $request->status;
                $payment = Payment::where('merchant_ref', $merchant_ref)->first();
                $billing = SchoolBilling::where('merchant_ref', $merchant_ref)->first();
                $billing_id = $billing->id;
                $school = School::findOrFail($billing->school_id);

                // Delete all payment whereNot Payment PAIDED

                // Update Status Invoice
                $payment->update([
                    'approval_status' => 1,
                    'approval_at' => Carbon::now(),
                   'status' => $status
                ]);
                // Update Status Payment
                $billing->update([
                    'status' => 'paid'
                ]);
                // Update User Plan
                $school->update([
                    'active_billing_id' => $billing_id
                ]);
			}
            elseif(in_array($request->status, ['REFUND', 'EXPIRED', 'FAILED']))
            {
                $merchant_ref = $request->merchant_ref;
                $status = $request->status;

                $payment = Payment::where('merchant_ref', $merchant_ref)->first();

                $payment->update([
                    'status' => $status
                ]);

            }
		}

		return response()->json(['success' => true]);
    }
}
