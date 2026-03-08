# NOWPayments Automated Withdrawals Setup Guide

## Overview
Your platform now uses NOWPayments Payouts API for automated withdrawals. When you approve a withdrawal, it's automatically sent via NOWPayments.

## Setup Steps

### 1. Get NOWPayments API Key

1. Go to https://nowpayments.io
2. Login to your account
3. Go to **Settings → API Keys**
4. Copy your **API Key**

### 2. Set Up Payout Wallets

1. In NOWPayments dashboard, go to **Payouts**
2. Add your payout wallets for each currency:
   - USDT BEP20
   - USDC BEP20
   - USDT TRC20
   - BNB BSC
3. Fund these wallets with crypto

### 3. Configure Your Application

Add to your `.env` file:
```env
NOWPAYMENTS_API_KEY=your_api_key_here
NOWPAYMENTS_IPN_SECRET=your_ipn_secret_here
```

### 4. Run Migration

```bash
php artisan migrate
```

### 5. Set Up Webhook (Production Only)

1. In NOWPayments dashboard, go to **Settings → Webhooks**
2. Add webhook URL: `https://yourdomain.com/nowpayments/payout-webhook`
3. Enable for **Payout** events

## How It Works

### User Flow:
1. User requests withdrawal
2. Status: `pending`

### Admin Flow:
1. You click **Approve** in admin panel
2. System automatically:
   - Calls NOWPayments API
   - Creates payout from your wallet
   - Sends crypto to user's address
3. Status: `approved`

### Automatic Completion:
1. NOWPayments processes the transaction
2. Webhook notifies your system
3. TXID is automatically saved
4. Status: `completed`
5. User receives email with TXID

## Benefits

✅ **Automated** - No manual transfers
✅ **Safe** - No copy/paste errors
✅ **Fast** - Instant processing
✅ **Tracked** - Automatic TXID recording
✅ **Lower Fees** - Cheaper than Binance
✅ **Scalable** - Handles unlimited withdrawals

## Testing (Localhost)

For testing, withdrawals will be marked as approved but won't actually send (NOWPayments requires production URL for webhooks).

To test in production:
1. Deploy to live server
2. Set up webhook URL
3. Test with small amounts first

## Monitoring

Check logs for payout activity:
```bash
tail -f storage/logs/laravel.log
```

## Troubleshooting

**Payout fails?**
- Check API key is correct
- Ensure payout wallets are funded
- Verify wallet addresses in NOWPayments dashboard

**Webhook not working?**
- Ensure webhook URL is publicly accessible
- Check webhook is enabled in NOWPayments
- Verify URL is correct (https required)

## Support

- NOWPayments Docs: https://documenter.getpostman.com/view/7907941/S1a32n38
- NOWPayments Support: support@nowpayments.io
