<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NowPaymentsService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://api.nowpayments.io/v1';

    public function __construct()
    {
        $this->apiKey = config('services.nowpayments.key');
    }

    /**
     * Create payment and RECEIVE address immediately
     */
    public function createPayment(string $payCurrency, int $orderId): array
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/payment', [
            'price_amount'      => 50,          // ✅ minimum deposit
            'price_currency'    => 'usd',
            'pay_currency'      => $payCurrency,
            'order_id'          => (string) $orderId,
            'order_description' => 'User Deposit',
            // ipn_callback_url optional in local
        ]);

        logger()->info('NOWPayments create response', $response->json());

        return $response->json();
    }

    /**
     * Optional: fetch payment status
     */
    public function getPaymentStatus(string $paymentId): array
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get($this->baseUrl . "/payment/{$paymentId}");

        logger()->info('NOWPayments status response', $response->json());

        return $response->json();
    }
}
