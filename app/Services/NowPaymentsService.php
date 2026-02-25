<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NowPaymentsService
{
    private string $baseUrl = 'https://api.nowpayments.io/v1';

    public function createPayment(int $orderId, string $payCurrency): array
    {
        $apiKey = config('services.nowpayments.api_key');
        
        if (empty($apiKey)) {
            logger()->error('NOWPayments API key not configured');
            return ['error' => 'Payment service not configured'];
        }
        
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/payment", [
            'price_amount'      => 50,
            'price_currency'    => 'usd',
            'pay_currency'      => $payCurrency,
            'order_id'          => (string) $orderId,
            'order_description' => 'User Deposit',
            'ipn_callback_url'  => url('/nowpayments/ipn'),
        ]);

        if ($response->failed()) {
            logger()->error('NOWPayments API error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        return $response->json() ?? [];
    }

    public function getPaymentStatus(string $paymentId): array
    {
        $apiKey = config('services.nowpayments.api_key');
        
        if (empty($apiKey)) {
            logger()->error('NOWPayments API key not configured');
            return [];
        }
        
        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
        ])->get("{$this->baseUrl}/payment/{$paymentId}");

        if ($response->failed()) {
            logger()->error('NOWPayments status check failed', [
                'payment_id' => $paymentId,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        return $response->json() ?? [];
    }

    /**
     * Verify IPN signature from NOWPayments.
     *
     * Accepts either the raw JSON string or an associative array payload.
     */
    public function verifyIpnSignature($payload, ?string $signature): bool
    {
        $secret = config('services.nowpayments.ipn_secret');

        if (empty($secret) || empty($signature)) {
            return false;
        }

        // Ensure we compute signature over the raw JSON payload
        $payloadJson = is_string($payload) ? $payload : json_encode($payload, JSON_UNESCAPED_SLASHES);

        // NOWPayments uses HMAC SHA512 for signatures (verify in dashboard/docs).
        $computed = hash_hmac('sha512', $payloadJson, (string) $secret);

        return hash_equals($computed, $signature);
    }
}
