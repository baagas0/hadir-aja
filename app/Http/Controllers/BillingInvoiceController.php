<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingInvoiceController extends Controller
{
    public function getIndex()
    {
        return view('billing-invoice.index');
    }
}
