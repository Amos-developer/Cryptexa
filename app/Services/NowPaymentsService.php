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
}