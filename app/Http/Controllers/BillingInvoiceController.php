<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageService;
use App\Models\School;
use App\Models\SchoolBilling;
use App\Models\SchoolBillingQuota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\TripayService;
use App\Models\Payment;

class BillingInvoiceController extends Controller
{
    public function getIndex()
    {
        if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
            ], 422);
        }

        $school_id = Auth::user()->school_id;
        $school = School::findOrFail($school_id);

        $data['billing'] = SchoolBilling::with('school', 'package', 'quotas')->find($school->active_billing_id);
        return view('billing-invoice.index', $data);
    }

    public function getChoosePackage()
    {
        return view('billing-invoice.choose-package');
    }

    public function postRegisterTrial()
    {    
        try {
            DB::beginTransaction();
            if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
                return response()->json([
                    'status' => 'gagal',
                    'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
                ], 422);
            }
    
            $school_id = Auth::user()->school_id;
            $school = School::findOrFail($school_id);

            $check_school_billing = SchoolBilling::select('id')->whereSchoolId($school->id)->count();
            if($check_school_billing > 0) {
                return response()->json([
                    'status' => 'gagal',
                    'message' =>  'Paket trial hanya diperuntukan untuk pengguna yang belum pernah terdaftar.'
                ], 422);
            }
    
            $package_trial_code = 'PKG-TRIAL';
            $package = Package::whereCode($package_trial_code)->first();
    
            $package_code = "09$package->id";
            $billing_code = 'BC'.$this->getPrefixCodeAttribute().$package_code.Carbon::now()->format('m').Carbon::now()->format('d');
    
            $start_date = Carbon::now();
            $end_date = Carbon::now()->addMonth(1);
    
            $status = 'paid';
    
            // Build Data Billing
            $school_billing = [
                'school_id'         => $school->id,
                'package_id'        => $package->id,
                'price'             => $package->bundling_price,
                'billing_code'      => $billing_code,
                'payment_duration'  => 1,
                'start_date'        => $start_date,
                'end_date'          => $end_date,
                'status'            => $status,

                'issue_date'        => Carbon::now(),
                'due_date'          => Carbon::now()->addDays(7),
            ];
            $billing = SchoolBilling::create($school_billing);
            School::find($school->id)->update([
                'active_billing_id' => $billing->id,
            ]);
            
            // Build Data Billing Quota
            $package_services = PackageService::with('service')->wherePackageId($package->id)->get();
            $school_billing_quota = [];
            foreach ($package_services as $key => $item) {
                $school_billing_quota[] = [
                    'school_billing_id' => $billing->id,
                    'package_id' => $item->package_id,
                    'service_id' => $item->service_id,
                    'service_code' => $item->service->code,
                    'user_count' => $item->user_count,
                    'limit_quota' => $item->limit_quota,
                    'used_quota' => 0,
                    'remaining_quota' => $item->limit_quota,
                ];
            }
    
            SchoolBillingQuota::insert($school_billing_quota);
            DB::commit();

            return redirect()->route('billing-invoice')->with('success', 'Paket Trial telah diaktifkan.');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function postRegisterPackage(Request $request)
    {    
        try {
            $request->validate([
                'package_id' => 'required|exists:packages,id',
                'channel' => 'required',
            ]);

            DB::beginTransaction();
            if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
                return response()->json([
                    'status' => 'gagal',
                    'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
                ], 422);
            }
    
            $school_id = Auth::user()->school_id;
            $school = School::findOrFail($school_id);

            $package = Package::findOrFail($request->package_id);
            $channel = (new TripayService())->channel($request->channel);
            $payment = Payment::query()
                ->where('package_id', $package->id)
                ->where('payment', $request->channel)
                ->where('approval_status', 0)
                ->where('expired_at', '>', now())
                ->first();

            // START TRIPAY
            if ($payment) return redirect('/checkout/detail/' . $payment->reference);
            $expired_at = now()->addDay();
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
                'status' => 'UNPAID',
                'approval_status' => 0,
                'approval_at' => null,
            ]);
            // END TRIPAY
    
            $package_code = "09$package->id";
            $billing_code = 'BC'.$this->getPrefixCodeAttribute().$package_code.Carbon::now()->format('m').Carbon::now()->format('d');
    
            $start_date = Carbon::now();
            $end_date = Carbon::now()->addMonth(1);
    
            $status = 'pending';
    
            // Build Data Billing
            $school_billing = [
                'school_id'         => $school->id,
                'package_id'        => $package->id,
                'merchant_ref'      => $merchant_ref,
                'price'             => $package->bundling_price,
                'billing_code'      => $billing_code,
                'payment_duration'  => 1,
                'start_date'        => $start_date,
                'end_date'          => $end_date,
                'status'            => $status,

                'issue_date'        => Carbon::now(),
                'due_date'          => Carbon::now()->addDays(7),
            ];
            $billing = SchoolBilling::create($school_billing);
            
            // Build Data Billing Quota
            $package_services = PackageService::with('service')->wherePackageId($package->id)->get();
            $school_billing_quota = [];
            foreach ($package_services as $key => $item) {
                $school_billing_quota[] = [
                    'school_billing_id' => $billing->id,
                    'package_id' => $item->package_id,
                    'service_id' => $item->service_id,
                    'service_code' => $item->service->code,
                    'user_count' => $item->user_count,
                    'limit_quota' => $item->limit_quota,
                    'used_quota' => 0,
                    'remaining_quota' => $item->limit_quota,
                ];
            }
    
            SchoolBillingQuota::insert($school_billing_quota);
            DB::commit();

            return redirect('/checkout/detail/' . $payment->reference);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function getPrefixCodeAttribute()
    {
        $code = SchoolBilling::count() + 1;
        $length = strlen($code);

        if ($length <= 4) {
            $prefix = str_repeat('0', 4 - $length);
            $code = $prefix . $code;
        }

        return $code;
    }
}
