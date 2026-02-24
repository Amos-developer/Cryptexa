# Automatic Payment Verification - Flow Diagram

## 🔄 Complete Payment Flow

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         USER INITIATES DEPOSIT                          │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  DepositController::store()                                             │
│  • Creates deposit record (status: pending)                             │
│  • Calls NOWPayments API to create payment                              │
│  • Saves payment_id to database                                         │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  DepositController::showQrCode()                                        │
│  • Fetches payment address from NOWPayments                             │
│  • Displays QR code to user                                             │
│  • Starts auto-refresh polling                                          │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                      USER SENDS CRYPTO TO ADDRESS                       │
│                    (e.g., 50 USDT to TRC20 address)                     │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                    BLOCKCHAIN TRANSACTION BROADCAST                     │
│                         (Waiting for confirmations)                     │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  NOWPayments Monitors Blockchain                                        │
│  • Detects incoming transaction                                         │
│  • Updates status to "confirming"                                       │
│  • Sends webhook to your server                                         │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  NowPaymentsWebhookController::handle()                                 │
│  ✓ Verifies HMAC SHA512 signature                                       │
│  ✓ Updates deposit status to "confirming"                               │
│  ✓ Saves actual amount received (pay_amount)                            │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│              BLOCKCHAIN CONFIRMATIONS COMPLETE (e.g., 12)               │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  NOWPayments Sends Final Webhook                                        │
│  • payment_status: "finished"                                           │
│  • actually_paid: 50.00                                                 │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  NowPaymentsWebhookController::handle()                                 │
│  ✓ Verifies signature                                                   │
│  ✓ Updates status to "completed"                                        │
│  ✓ Dispatches ProcessDepositPayment job                                 │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  ProcessDepositPayment Job (Queued)                                     │
│  ✓ Locks deposit record (prevents double-processing)                    │
│  ✓ Checks if already processed (processed_at)                           │
│  ✓ Credits user EXACT amount (pay_amount)                               │
│  ✓ Calculates referral commissions (3 levels)                           │
│  ✓ Credits referrers instantly                                          │
│  ✓ Creates referral earning records                                     │
│  ✓ Sends notifications to user and referrers                            │
│  ✓ Marks deposit as processed (processed_at = now)                      │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                          ✅ PAYMENT COMPLETE                            │
│  • User balance updated                                                 │
│  • Referrers paid commissions                                           │
│  • Notifications sent                                                   │
│  • No admin intervention needed                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

## 🔐 Security Flow

```
┌─────────────────────────────────────────────────────────────────────────┐
│                      NOWPayments Sends Webhook                          │
│  POST /nowpayments/ipn                                                  │
│  Header: x-nowpayments-sig: {hmac_sha512_signature}                    │
│  Body: {payment_data}                                                   │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  Signature Verification                                                 │
│  computed = hmac_sha512(payload, IPN_SECRET)                            │
│  if (computed !== signature) → 403 Forbidden                            │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼ (Valid)
┌─────────────────────────────────────────────────────────────────────────┐
│  Process Webhook                                                        │
│  • Update deposit status                                                │
│  • Dispatch processing job                                              │
└─────────────────────────────────────────────────────────────────────────┘
```

## 🛡️ Double-Processing Prevention

```
┌─────────────────────────────────────────────────────────────────────────┐
│  ProcessDepositPayment Job Starts                                       │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  DB::transaction(function() {                                           │
│    $deposit = Deposit::lockForUpdate()->find($id);  ← Database Lock     │
│  })                                                                     │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  Check: if ($deposit->processed_at) {                                   │
│    return; // Already processed, skip                                   │
│  }                                                                      │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼ (Not processed)
┌─────────────────────────────────────────────────────────────────────────┐
│  Process Payment                                                        │
│  • Credit user                                                          │
│  • Pay referrals                                                        │
│  • Set processed_at = now()                                             │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  ✅ Safe: Can't process same deposit twice                              │
└─────────────────────────────────────────────────────────────────────────┘
```

## 💰 Amount Crediting Logic

```
┌─────────────────────────────────────────────────────────────────────────┐
│  Deposit Record                                                         │
│  • amount: 50.00 (Expected amount in USD)                               │
│  • pay_amount: 50.00 (Actual USDT received)                             │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  Credit Calculation                                                     │
│  $creditAmount = $deposit->pay_amount ?? $deposit->amount;              │
│  // Uses actual received amount, not expected                           │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  User Balance Update                                                    │
│  $user->increment('balance', $creditAmount);                            │
│  // User gets EXACTLY what they deposited                               │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  Referral Commissions                                                   │
│  Level 1: $creditAmount × 2% = $1.00                                    │
│  Level 2: $creditAmount × 1% = $0.50                                    │
│  Level 3: $creditAmount × 0.5% = $0.25                                  │
│  // Calculated on actual amount, not expected                           │
└─────────────────────────────────────────────────────────────────────────┘
```

## 📊 Status Transitions

```
pending ──────────────────────────────────────────────────────────────┐
   │                                                                   │
   │ (Payment detected)                                                │
   ▼                                                                   │
confirming ───────────────────────────────────────────────────────────┤
   │                                                                   │
   │ (Confirmations complete)                                          │
   ▼                                                                   │
completed ────────────────────────────────────────────────────────────┤
   │                                                                   │
   │ (Job dispatched)                                                  │
   ▼                                                                   │
processed (processed_at set) ─────────────────────────────────────────┘
   │
   │ (Cannot be processed again)
   ▼
✅ FINAL STATE
```

## 🔄 Parallel Flows

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         WEBHOOK FLOW (Primary)                          │
│  NOWPayments → Webhook → Update Status → Dispatch Job → Process        │
└─────────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────────┐
│                      POLLING FLOW (Backup/Fallback)                     │
│  Frontend → Check Status API → Fetch from NOWPayments → Update Status  │
└─────────────────────────────────────────────────────────────────────────┘

Both flows can run simultaneously. Webhook is faster and more reliable.
Polling provides real-time UI updates and fallback if webhook fails.
```

## 🎯 Key Points

1. **Webhook is Primary**: Fastest and most reliable method
2. **Polling is Backup**: Provides UI updates and fallback
3. **Signature Verified**: Every webhook authenticated
4. **Exact Amounts**: Users get exactly what they deposited
5. **Idempotent**: Can't process same deposit twice
6. **Atomic**: Database transactions ensure consistency
7. **Queued**: Processing doesn't block webhook response
8. **Logged**: Every step logged for debugging
