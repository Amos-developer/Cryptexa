# NOWPayments "Expired" Status Explanation

## Question
**When the deposit record shows "Expired", does it mean the address is expired?**

## Answer
**YES** - When a NOWPayments deposit shows "Expired" status, it means the payment address has expired and can no longer receive payments.

---

## How NOWPayments Expiration Works

### 1. Payment Address Lifecycle

**Created (Pending):**
- User initiates deposit
- NOWPayments generates unique payment address
- Address is valid for limited time (typically 1-2 hours)
- Status: `pending` or `waiting`

**Active Period:**
- User can send cryptocurrency to the address
- NOWPayments monitors for incoming transactions
- Status: `pending`, `waiting`, or `confirming`

**Expired:**
- Time limit exceeded without payment
- Address becomes invalid
- Cannot receive payments anymore
- Status: `expired`

**Completed:**
- Payment received and confirmed
- Status: `completed`

---

## Status Flow in Your System

### Status Mapping (from webhook):

```php
$statusMap = [
    'waiting'    => 'pending',      // Address active, waiting for payment
    'confirming' => 'confirming',   // Payment received, confirming
    'finished'   => 'completed',    // Payment confirmed
    'expired'    => 'expired',      // Address expired, no payment received
    'failed'     => 'failed',       // Payment failed
];
```

### What Happens When Expired:

1. **NOWPayments sends webhook** with `payment_status: 'expired'`
2. **Your system updates deposit** to `status: 'expired'`
3. **Address becomes invalid** - Cannot receive payments
4. **User must create new deposit** to get new address

---

## Why Addresses Expire

### Security Reasons:
✅ Prevents address reuse
✅ Reduces risk of delayed payments
✅ Ensures accurate exchange rates
✅ Maintains clean payment tracking

### Operational Reasons:
✅ Frees up system resources
✅ Prevents stale transactions
✅ Encourages timely payments
✅ Maintains accurate records

---

## User Experience

### Scenario 1: User Pays Before Expiration
1. User creates deposit → Gets address
2. User sends crypto within time limit
3. Payment confirmed → Balance credited
4. Status: `completed` ✅

### Scenario 2: User Doesn't Pay in Time
1. User creates deposit → Gets address
2. User delays sending crypto
3. Address expires after time limit
4. Status: `expired` ❌
5. User must create NEW deposit for new address

### Scenario 3: User Pays After Expiration
1. Address already expired
2. User sends crypto to expired address
3. **Payment may be lost or delayed** ⚠️
4. Requires manual intervention/support

---

## Important Notes

### For Users:
⚠️ **Always pay before address expires**
⚠️ **Don't reuse expired addresses**
⚠️ **Create new deposit if address expired**
⚠️ **Check expiration time before sending**

### For Admins:
📌 Expired deposits don't credit user balance
📌 Expired addresses cannot be reactivated
📌 Users need to create new deposit
📌 Monitor expired deposits for support issues

---

## Database Structure

### Deposit Table Fields:
```
- status: 'pending', 'confirming', 'completed', 'expired', 'failed'
- pay_address: The crypto address (becomes invalid when expired)
- payment_id: NOWPayments payment ID
- created_at: When deposit was created
- updated_at: When status last changed
```

### Status Constants in Model:
```php
public const STATUS_WAITING   = 'pending';
public const STATUS_COMPLETED = 'completed';
public const STATUS_EXPIRED   = 'expired';
```

---

## Webhook Processing

### When NOWPayments Sends "expired" Status:

```php
// Webhook receives: payment_status = 'expired'
$newStatus = $statusMap['expired']; // Maps to 'expired'

// Update deposit
$deposit->update([
    'status' => 'expired',
    // Address remains in database but is invalid
]);

// NO payment processing occurs
// NO balance credited
// NO commissions paid
```

---

## Typical Expiration Times

### NOWPayments Standard:
- **Bitcoin (BTC):** ~1 hour
- **Ethereum (ETH):** ~1 hour  
- **USDT (TRC20):** ~1 hour
- **Other coins:** Varies by network

### Factors Affecting Expiration:
- Network congestion
- Exchange rate volatility
- NOWPayments policy
- Payment method

---

## How to Handle Expired Deposits

### For Users:
1. Check deposit history
2. See "Expired" status
3. Create new deposit
4. Get new address
5. Complete payment before new expiration

### For Admins:
1. Monitor expired deposits
2. Contact users if needed
3. Cannot reactivate expired addresses
4. Guide users to create new deposits
5. Check if payment was sent to expired address (requires NOWPayments support)

---

## Prevention Tips

### Display to Users:
✅ Show expiration countdown timer
✅ Send reminder notifications
✅ Display clear expiration time
✅ Warn before address expires

### System Improvements:
✅ Email notification before expiration
✅ Auto-refresh address option
✅ Longer expiration times (if possible)
✅ Clear expired deposit messaging

---

## Summary

| Status | Address Valid? | Can Receive Payment? | Balance Credited? |
|--------|---------------|---------------------|-------------------|
| Pending | ✅ Yes | ✅ Yes | ❌ Not yet |
| Confirming | ✅ Yes | ⚠️ Already received | ⏳ Processing |
| Completed | ❌ No (used) | ❌ No | ✅ Yes |
| **Expired** | **❌ No** | **❌ No** | **❌ No** |
| Failed | ❌ No | ❌ No | ❌ No |

---

## Conclusion

**YES** - "Expired" status means the payment address has expired and is no longer valid. Users cannot send payments to expired addresses and must create a new deposit to get a fresh address. This is a standard security and operational practice by NOWPayments to ensure timely payments and accurate transaction tracking.

**Action Required:** Users with expired deposits must create a new deposit to receive a new, valid payment address.
