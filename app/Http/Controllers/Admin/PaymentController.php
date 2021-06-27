<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Transaction;

class PaymentController extends Controller
{
    public function make(Request $request)
    {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $status = Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        return response()->json($status);
    }

    public function index()
    {
        return view('admin.payments.index');
    }
}
