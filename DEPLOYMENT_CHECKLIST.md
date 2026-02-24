# Automatic Payment Verification - Deployment Checklist

## ✅ Pre-Deployment Checklist

### 1. Environment Configuration
- [ ] Add `NOWPAYMENTS_API_KEY` to .env
- [ ] Add `NOWPAYMENTS_IPN_SECRET` to .env
- [ ] Verify config/services.php has correct keys
- [ ] Test .env values are loaded: `php artisan config:clear`

### 2. NOWPayments Dashboard Setup
- [ ] Login to NOWPayments dashboard
- [ ] Navigate to Settings → API
- [ ] Copy API Key to .env
- [ ] Generate IPN Secret Key
- [ ] Copy IPN Secret to .env
- [ ] Set IPN Callback URL: `https://yourdomain.com/nowpayments/ipn`
- [ ] Enable IPN notifications
- [ ] Save settings

### 3. Database Verification
- [ ] Verify `deposits` table has `processed_at` column
- [ ] Verify `deposits` table has `pay_amount` column
- [ ] Verify `deposits` table has `pay_address` column
- [ ] Verify `deposits` table has `pay_currency` column
- [ ] Run: `php artisan migrate` (if needed)

### 4. Queue Configuration
- [ ] Verify `QUEUE_CONNECTION=database` in .env
- [ ] Run: `php artisan queue:table` (if not exists)
- [ ] Run: `php artisan migrate`
- [ ] Test queue: `php artisan queue:work --once`

### 5. Code Verification
- [ ] Verify `NowPaymentsWebhookController.php` exists
- [ ] Verify webhook route in `routes/web.php`
- [ ] Verify CSRF exception in `VerifyCsrfToken.php`
- [ ] Verify `ProcessDepositPayment.php` job exists
- [ ] Run: `php artisan route:list | grep nowpayments`

## 🚀 Deployment Steps

### Step 1: Deploy Code
```bash
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 2: Start Queue Worker
```bash
# For testing (foreground)
php artisan queue:work

# For production (use Supervisor)
# Create: /etc/supervisor/conf.d/cryptexa-worker.conf
```

### Supervisor Configuration
```ini
[program:cryptexa-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/cryptexa/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/cryptexa/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start cryptexa-worker:*
```

### Step 3: Test Webhook Endpoint
```bash
# Test endpoint is accessible
curl -X POST https://yourdomain.com/nowpayments/ipn \
  -H "Content-Type: application/json" \
  -d '{"test": true}'

# Should return 403 (invalid signature) - this is correct!
```

## 🧪 Testing Checklist

### Test 1: Create Deposit
- [ ] Login as user
- [ ] Go to deposit page
- [ ] Select cryptocurrency
- [ ] Click deposit
- [ ] Verify QR code appears
- [ ] Verify deposit record created in database
- [ ] Verify status is `pending`

### Test 2: Simulate Payment
```bash
# Get deposit ID from database
php artisan test:payment-webhook {deposit_id}

# Process the job
php artisan queue:work --once
```

### Test 3: Verify Results
- [ ] Check user balance increased
- [ ] Check deposit status is `completed`
- [ ] Check `processed_at` is set
- [ ] Check referral commissions credited (if user has referrer)
- [ ] Check notifications created
- [ ] Check logs for success messages

### Test 4: Double-Processing Prevention
```bash
# Try to process same deposit again
php artisan test:payment-webhook {same_deposit_id}
php artisan queue:work --once

# Verify balance NOT increased again
# Verify logs show "already processed"
```

## 📊 Monitoring Checklist

### Daily Monitoring
- [ ] Check queue worker is running: `supervisorctl status`
- [ ] Check failed jobs: `php artisan queue:failed`
- [ ] Check Laravel logs: `tail -f storage/logs/laravel.log`
- [ ] Check NOWPayments webhook logs in dashboard
- [ ] Verify deposits are processing automatically

### Weekly Monitoring
- [ ] Review all completed deposits
- [ ] Verify all have `processed_at` timestamp
- [ ] Verify user balances match deposit totals
- [ ] Verify referral commissions calculated correctly
- [ ] Check for any stuck deposits

## 🚨 Troubleshooting Checklist

### Webhook Not Receiving
- [ ] Verify URL is publicly accessible
- [ ] Check NOWPayments dashboard webhook logs
- [ ] Verify IPN URL is correct
- [ ] Check firewall/security groups
- [ ] Test with curl from external server

### Deposits Not Processing
- [ ] Check queue worker is running
- [ ] Check failed jobs: `php artisan queue:failed`
- [ ] Check Laravel logs for errors
- [ ] Verify database connection
- [ ] Check `processed_at` column exists

### Balance Not Updated
- [ ] Verify job was dispatched
- [ ] Check job was processed: `php artisan queue:work --once`
- [ ] Check logs for "ProcessDepositPayment: completed"
- [ ] Verify user balance in database
- [ ] Check for transaction locks

### Signature Verification Failed
- [ ] Verify IPN Secret matches NOWPayments dashboard
- [ ] Check .env file has correct secret
- [ ] Run: `php artisan config:clear`
- [ ] Check logs for signature mismatch
- [ ] Verify webhook payload format

## 📝 Post-Deployment Verification

### Immediate (First Hour)
- [ ] Monitor logs continuously
- [ ] Test with small deposit ($50)
- [ ] Verify webhook received
- [ ] Verify balance updated
- [ ] Verify notifications sent

### First Day
- [ ] Process 5-10 test deposits
- [ ] Verify all processed correctly
- [ ] Check referral commissions
- [ ] Monitor queue worker stability
- [ ] Review error logs

### First Week
- [ ] Monitor all deposits
- [ ] Verify no manual intervention needed
- [ ] Check user feedback
- [ ] Optimize queue worker if needed
- [ ] Document any issues

## ✅ Success Criteria

- ✅ Deposits automatically verified within 5 minutes
- ✅ Users credited exact amount deposited
- ✅ No manual admin intervention required
- ✅ Referral commissions calculated correctly
- ✅ No double-crediting incidents
- ✅ Queue worker running stable
- ✅ Webhook receiving all notifications
- ✅ Error rate < 1%

## 📞 Emergency Contacts

If critical issues occur:
1. Stop queue worker: `supervisorctl stop cryptexa-worker:*`
2. Check logs: `tail -100 storage/logs/laravel.log`
3. Check failed jobs: `php artisan queue:failed`
4. Retry failed: `php artisan queue:retry all`
5. Restart worker: `supervisorctl start cryptexa-worker:*`

## 🎉 Deployment Complete!

Once all checklist items are complete, the automatic payment verification system is live and operational.
