<?php

namespace App\Http\Controllers;

use App\Services\PipraPay;
use Illuminate\Http\Request;

class PipraPayController extends Controller
{
    protected $pipra;

    public function __construct()
    {
        $this->pipra = new PipraPay(
            config('services.piprapay.key'),
            config('services.piprapay.url'),
            'BDT'
        );
    }

    public function createPayment(Request $request)
    {
        $response = $this->pipra->createCharge([
            'full_name' => 'John Doe',
            'email_mobile' => 'john@example.com',
            'amount' => 50,
            'metadata' => ['invoiceid' => 'INV-123'],
            'return_type' => 'GET',
            'redirect_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'webhook_url' => route('payment.webhook')
        ]);
        return redirect($response['pp_url']);
    }

    public function success()
    {
        return "Payment Successful!";
    }

    public function cancel()
    {
        return "Payment Cancelled!";
    }

    public function webhook(Request $request)
    {
        $data = $this->pipra->handleWebhook(config('services.piprapay.key'));

        if ($data['status']) {
            // Handle the payment data, e.g., update DB
            return response()->json(['message' => 'Webhook handled'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function verify(Request $request)
    {
        $result = $this->pipra->verifyPayment($request->pp_id);
        return response()->json($result);
    }
}
