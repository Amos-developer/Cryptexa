<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NowPaymentsService
{
    private string $baseUrl = 'https://api.nowpayments.io/v1';

    public function createPayment(int $orderId, string $payCurrency): array
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.nowpayments.key'),
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/payment", [
            'price_amount'      => 50, // minimum deposit
            'price_currency'    => 'usd',
            'pay_currency'      => $payCurrency,
            'order_id'          => (string) $orderId,
            'order_description' => 'User Deposit',
        ]);

        return $response->json();
    }

    public function getPaymentStatus(string $paymentId): array
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.nowpayments.key'),
        ])->get("{$this->baseUrl}/payment/{$paymentId}");

        return $response->json();
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
