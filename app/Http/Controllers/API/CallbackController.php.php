<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function update(Request $request)
    {
        $data = file_get_contents("php://input");
		$callbackSignature = $request->header('X-Callback-Signature') ?? '';
		$signature = hash_hmac('sha256', $data, config('services.tripay.private'));

		if( $callbackSignature !== $signature ) {
			exit("Invalid Signature");
		}

		$event = $request->header('X_CALLBACK_EVENT');

		if( $event == 'payment_status' )
		{
			if( $request->status == 'PAID' )
			{
                // Get Info

                // Delete all payment whereNot Payment PAIDED

                // Update Status Invoice

                // Update Status Payment

                // Update User Plan

			}
            elseif(in_array($request->status, ['REFUND', 'EXPIRED', 'FAILED']))
            {
                
            }
		}

		return response()->json(['success' => true]);
    }
}
