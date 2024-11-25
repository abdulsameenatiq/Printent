<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function verifyPayment(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $secretKey = env('MOYASAR_SECRET_KEY');

        $response = Http::withBasicAuth($secretKey, '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if ($response->ok()) {
            $payment = $response->json();
            if ($payment['status'] === 'paid') {
                return response()->json(['success' => true, 'payment' => $payment]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Payment verification failed']);
    }

    public function paymentSuccess()
    {
        return view('checkout.success'); // Create a success Blade template for user confirmation
    }
}
