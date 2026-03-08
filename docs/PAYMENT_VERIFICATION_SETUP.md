# Automatic Payment Verification Setup Guide

## Overview
The system now automatically verifies deposits via NOWPayments webhook and credits users the EXACT amount they deposited.

## How It Works

### 1. User Makes Deposit
- User selects cryptocurrency and amount
- System creates deposit record with status `pending`
- NOWPayments generates unique payment address
- User sends crypto to the address

### 2. Automatic Verification
- NOWPayments detects payment on blockchain
- Sends webhook to: `https://yourdomain.com/nowpayments/ipn`
- System verifies webhook signature for security
- Updates deposit status: `pending` → `confirming` → `completed`

### 3. Automatic Processing
- When status becomes `completed`, system:
  - Credits user EXACT amount deposited (uses `pay_amount` field)
  - Calculates referral commissions on actual amount
  - Sends notifications to user and referrers
  - Marks deposit as `processed_at` to prevent double-crediting

## Setup Instructions

### Step 1: Configure NOWPayments

1. Login to NOWPayments dashboard
2. Go to Settings → API
3. Copy your API Key
4. Generate IPN Secret Key
5. Set IPN Callback URL to: `https://yourdomain.com/nowpayments/ipn`

### Step 2: Update .env File

```env
NOWPAYMENTS_API_KEY=your_api_key_here
NOWPAYMENTS_IPN_SECRET=your_ipn_secret_here
```

### Step 3: Configure Queue Worker

The system uses queued jobs for processing. Run:

```bash
php artisan queue:work
```

For production, use Supervisor to keep queue worker running.

### Step 4: Test Webhook (Optional)

Test webhook locally using ngrok:

```bash
# Install ngrok
ngrok http 8000

# Update NOWPayments IPN URL to ngrok URL
https://your-ngrok-url.ngrok.io/nowpayments/ipn
```

## Security Features

### 1. Signature Verification
- Every webhook is verified using HMAC SHA512
- Invalid signatures are rejected with 403 error

### 2. Idempotent Processing
- `processed_at` timestamp prevents double-crediting
- Database transaction locks prevent race conditions

### 3. Exact Amount Crediting
- Users receive EXACTLY what they deposited
- System uses `pay_amount` (actual received) not `amount` (expected)

## Status Flow

```
pending → confirming → completed
   ↓          ↓           ↓
expired    failed    processed
```

## Webhook Payload Example

```json
{
  "order_id": "123",
  "payment_status": "finished",
  "pay_address": "0x...",
  "pay_currency": "usdttrc20",
  "pay_amount": 50.00,
  "actually_paid": 50.00,
  "price_amount": 50,
  "price_currency": "usd"
}
```

## Troubleshooting

### Webhook Not Receiving
1. Check NOWPayments dashboard for webhook logs
2. Verify IPN URL is publicly accessible
3. Check Laravel logs: `storage/logs/laravel.log`

### Deposits Not Processing
1. Ensure queue worker is running: `php artisan queue:work`
2. Check failed jobs: `php artisan queue:failed`
3. Verify database has `processed_at` column

### Double Crediting Prevention
- System checks `processed_at` field before crediting
- Database transaction locks prevent concurrent processing
- Each deposit can only be processed once

## Manual Testing

Test the webhook endpoint:

```bash
curl -X POST https://yourdomain.com/nowpayments/ipn \
  -H "Content-Type: application/json" \
  -H "x-nowpayments-sig: YOUR_SIGNATURE" \
  -d '{
    "order_id": "1",
    "payment_status": "finished",
    "actually_paid": 50.00
  }'
```

## Files Modified

1. `app/Http/Controllers/NowPaymentsWebhookController.php` - Webhook handler
2. `app/Jobs/ProcessDepositPayment.php` - Credits exact amount
3. `config/services.php` - NOWPayments config
4. `.env.example` - Environment variables
5. `routes/web.php` - Webhook route (already exists)

## Support

For issues, check:
- Laravel logs: `storage/logs/laravel.log`
- NOWPayments dashboard: Webhook logs
- Queue jobs: `php artisan queue:failed`
