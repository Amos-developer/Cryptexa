# Automatic Payment Verification System

## 📋 Overview

This system automatically verifies cryptocurrency deposits and credits users the exact amount they deposited, without any manual admin intervention.

## ✨ Features

- ✅ **Automatic Verification** - Deposits verified via NOWPayments webhook
- ✅ **Exact Amount Crediting** - Users receive exactly what they deposited
- ✅ **Instant Processing** - Credits within seconds of blockchain confirmation
- ✅ **Secure** - HMAC SHA512 signature verification on all webhooks
- ✅ **Idempotent** - Cannot credit same deposit twice
- ✅ **Automatic Commissions** - Referral commissions calculated and paid instantly
- ✅ **Real-time Updates** - Status updates via webhook and polling
- ✅ **No Admin Work** - Fully automated, zero manual intervention

## 🚀 Quick Start

### 1. Configure Environment

Add to `.env`:
```env
NOWPAYMENTS_API_KEY=your_api_key_here
NOWPAYMENTS_IPN_SECRET=your_ipn_secret_here
```

### 2. Configure NOWPayments

1. Login to [NOWPayments Dashboard](https://nowpayments.io)
2. Go to Settings → API
3. Set IPN Callback URL: `https://yourdomain.com/nowpayments/ipn`
4. Copy API Key and IPN Secret to `.env`

### 3. Start Queue Worker

```bash
php artisan queue:work
```

### 4. Test

```bash
# Create test deposit via UI
# Then simulate payment:
php artisan test:payment-webhook {deposit_id}
php artisan queue:work --once
```

## 📚 Documentation

- **[Setup Guide](PAYMENT_VERIFICATION_SETUP.md)** - Detailed setup instructions
- **[Quick Reference](PAYMENT_VERIFICATION_QUICK_REFERENCE.md)** - Quick commands and tips
- **[Implementation Summary](IMPLEMENTATION_SUMMARY.md)** - Technical implementation details
- **[Flow Diagram](PAYMENT_FLOW_DIAGRAM.md)** - Visual flow diagrams
- **[Deployment Checklist](DEPLOYMENT_CHECKLIST.md)** - Complete deployment checklist

## 🔧 How It Works

```
User Deposits → NOWPayments Detects → Webhook Fired → Status Updated → 
Job Dispatched → User Credited → Referrals Paid → Notifications Sent
```

### Step-by-Step

1. User initiates deposit and receives payment address
2. User sends crypto to the address
3. NOWPayments monitors blockchain and detects payment
4. NOWPayments sends webhook to your server
5. System verifies signature and updates status
6. Processing job credits user exact amount
7. Referral commissions calculated and paid
8. Notifications sent to user and referrers

## 🛡️ Security

### Signature Verification
Every webhook is verified using HMAC SHA512:
```php
$computed = hash_hmac('sha512', $payload, $secret);
if (!hash_equals($computed, $signature)) {
    return 403; // Reject
}
```

### Double-Processing Prevention
```php
// Check if already processed
if ($deposit->processed_at) {
    return; // Skip
}

// Process and mark
$user->increment('balance', $amount);
$deposit->processed_at = now();
```

### Database Locks
```php
DB::transaction(function () {
    $deposit = Deposit::lockForUpdate()->find($id);
    // Process safely
});
```

## 💰 Exact Amount Crediting

```php
// Use actual received amount, not expected
$creditAmount = $deposit->pay_amount ?? $deposit->amount;
$user->increment('balance', $creditAmount);

// Commissions calculated on actual amount
$commission = $creditAmount * $rate;
```

## 📁 Files

### Created
- `app/Http/Controllers/NowPaymentsWebhookController.php` - Webhook handler
- `app/Console/Commands/TestPaymentWebhook.php` - Testing command
- Documentation files (this and others)

### Modified
- `app/Jobs/ProcessDepositPayment.php` - Credits exact amount
- `app/Http/Controllers/DepositController.php` - Uses job dispatch
- `config/services.php` - Fixed config key
- `.env.example` - Added NOWPayments config

### Already Configured
- `routes/web.php` - Webhook route exists
- `app/Http/Middleware/VerifyCsrfToken.php` - CSRF exception exists
- `app/Services/NowPaymentsService.php` - Signature verification ready
- Database - `processed_at` column exists

## 🧪 Testing

### Test Command
```bash
# Simulate payment completion
php artisan test:payment-webhook {deposit_id}

# Process the job
php artisan queue:work --once
```

### Manual Webhook Test
```bash
curl -X POST http://localhost:8000/nowpayments/ipn \
  -H "Content-Type: application/json" \
  -H "x-nowpayments-sig: test_signature" \
  -d '{
    "order_id": "1",
    "payment_status": "finished",
    "actually_paid": 50.00
  }'
```

## 📊 Monitoring

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Check Queue
```bash
# Failed jobs
php artisan queue:failed

# Retry failed
php artisan queue:retry all
```

### Check Status
```bash
# Queue worker
supervisorctl status cryptexa-worker

# Restart if needed
supervisorctl restart cryptexa-worker:*
```

## 🚨 Troubleshooting

### Webhook Not Receiving
- Verify URL is publicly accessible
- Check NOWPayments dashboard webhook logs
- Verify IPN Secret matches

### Deposits Not Processing
- Check queue worker is running
- Check failed jobs: `php artisan queue:failed`
- Check Laravel logs for errors

### Balance Not Updated
- Verify job was dispatched
- Process manually: `php artisan queue:work --once`
- Check logs for "ProcessDepositPayment: completed"

## 📈 Status Flow

```
pending → confirming → completed → processed
```

- **pending**: Waiting for payment
- **confirming**: Payment detected, waiting for confirmations
- **completed**: Confirmations complete, ready to process
- **processed**: User credited, commissions paid (processed_at set)

## ✅ Success Criteria

- ✅ Deposits verified within 5 minutes
- ✅ Users credited exact amount
- ✅ No manual intervention needed
- ✅ Commissions calculated correctly
- ✅ No double-crediting
- ✅ Queue worker stable
- ✅ Webhook receiving notifications

## 🎯 Benefits

1. **Zero Manual Work** - Admin doesn't touch deposits
2. **Exact Amounts** - Users get exactly what they sent
3. **Instant** - Credits within seconds
4. **Secure** - Signature verification prevents fraud
5. **Safe** - Can't credit twice
6. **Transparent** - Real-time status updates
7. **Automated** - Referrals paid automatically

## 📞 Support

For issues:
1. Check logs: `storage/logs/laravel.log`
2. Check failed jobs: `php artisan queue:failed`
3. Check NOWPayments dashboard
4. Review documentation files

## 🎉 Result

Users can deposit crypto and get credited automatically. The system ensures they receive exactly what they deposited, and referral commissions are calculated and paid instantly on the actual received amount.

**No admin intervention required!**
