# Automatic Payment Verification - Quick Reference

## ✅ What's Implemented

### 1. Webhook Handler
- **File**: `app/Http/Controllers/NowPaymentsWebhookController.php`
- **Route**: `POST /nowpayments/ipn` (no auth/CSRF required)
- **Security**: HMAC SHA512 signature verification
- **Function**: Receives payment updates from NOWPayments

### 2. Exact Amount Crediting
- **File**: `app/Jobs/ProcessDepositPayment.php`
- **Logic**: Credits `pay_amount` (actual received) not `amount` (expected)
- **Safety**: Uses `processed_at` timestamp to prevent double-crediting
- **Transaction**: Database locks prevent race conditions

### 3. Automatic Status Updates
- **Webhook**: Updates status automatically when payment detected
- **Polling**: Frontend can still poll for status updates
- **Flow**: `pending` → `confirming` → `completed`

## 🔧 Configuration Required

### 1. Environment Variables (.env)
```env
NOWPAYMENTS_API_KEY=your_api_key_here
NOWPAYMENTS_IPN_SECRET=your_ipn_secret_here
```

### 2. NOWPayments Dashboard
- Set IPN Callback URL: `https://yourdomain.com/nowpayments/ipn`
- Enable IPN notifications
- Copy IPN Secret Key

### 3. Queue Worker
```bash
# Development
php artisan queue:work

# Production (use Supervisor)
php artisan queue:work --daemon
```

## 🧪 Testing

### Test Command
```bash
# Simulate payment completion
php artisan test:payment-webhook {deposit_id}

# Then process the job
php artisan queue:work
```

### Manual Webhook Test
```bash
curl -X POST http://localhost:8000/nowpayments/ipn \
  -H "Content-Type: application/json" \
  -H "x-nowpayments-sig: test_signature" \
  -d '{
    "order_id": "1",
    "payment_status": "finished",
    "actually_paid": 50.00,
    "pay_address": "0x123...",
    "pay_currency": "usdttrc20"
  }'
```

## 🛡️ Security Features

1. **Signature Verification**: Every webhook verified with HMAC SHA512
2. **Idempotent Processing**: Can't credit same deposit twice
3. **Database Locks**: Prevents concurrent processing
4. **Exact Amounts**: Users get exactly what they deposited

## 📊 Status Mapping

| NOWPayments Status | System Status |
|-------------------|---------------|
| waiting           | pending       |
| confirming        | confirming    |
| finished          | completed     |
| expired           | expired       |
| failed            | failed        |

## 🔍 Monitoring

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Check Failed Jobs
```bash
php artisan queue:failed
```

### Retry Failed Job
```bash
php artisan queue:retry {job_id}
```

## 📝 Key Points

- ✅ Users credited EXACT amount deposited
- ✅ Webhook handles automatic verification
- ✅ No admin intervention needed
- ✅ Double-crediting prevented
- ✅ Referral commissions calculated on actual amount
- ✅ Instant notifications sent
- ✅ Secure signature verification

## 🚀 Deployment Checklist

- [ ] Add NOWPAYMENTS_API_KEY to .env
- [ ] Add NOWPAYMENTS_IPN_SECRET to .env
- [ ] Configure webhook URL in NOWPayments dashboard
- [ ] Start queue worker (Supervisor in production)
- [ ] Test with small deposit
- [ ] Monitor logs for webhook calls
- [ ] Verify user balance updated correctly

## 📞 Support

If deposits not processing:
1. Check queue worker is running
2. Check NOWPayments webhook logs
3. Check Laravel logs for errors
4. Verify IPN secret matches
5. Test webhook endpoint is accessible
