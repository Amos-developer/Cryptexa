<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NowPaymentsPayoutService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.nowpayments.io/v1';

    public function __construct()
    {
        $this->apiKey = config('services.nowpayments.api_key');
    }

    /**
     * Create a payout
     */
    public function createPayout($address, $amount, $currency = 'usdtbep20')
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/payout", [
                'withdrawals' => [
                    [
                        'address' => $address,
                        'currency' => strtolower($currency),
                        'amount' => $amount,
                        'ipn_callback_url' => route('nowpayments.ipn'),
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('NOWPayments payout created', $data);
                return [
                    'success' => true,
                    'data' => $data,
                    'id' => $data['id'] ?? null,
                ];
            }

            Log::error('NOWPayments payout failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'Payout failed'
            ];

        } catch (\Exception $e) {
            Log::error('NOWPayments payout exception: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get payout status
     */
    public function getPayoutStatus($payoutId)
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
            ])->get("{$this->baseUrl}/payout/{$payoutId}");

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to get payout status'
            ];

        } catch (\Exception $e) {
            Log::error('NOWPayments status check exception: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Map network to NOWPayments currency code
     */
    public static function mapCurrency($network)
    {
        return match($network) {
            'BEP20' => 'usdtbep20',
            'USDC_BEP20' => 'usdcbep20',
            'TRC20' => 'usdttrc20',
            'BNB_BSC' => 'bnbbsc',
            default => 'usdtbep20',
        };
    }
}
