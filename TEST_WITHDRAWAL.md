# Withdrawal System Test Guide

## Prerequisites
1. Run migration to add email verification columns:
   ```bash
   php artisan migrate:fresh --seed
   ```

## Test Steps

### 1. Setup Withdrawal PIN
- Go to Settings → Set Withdrawal PIN
- Create a 4-digit PIN (e.g., 1234)

### 2. Complete a Pool (Required)
- Go to Home
- Activate any pool with minimum amount
- Wait for pool to complete OR manually update database:
  ```sql
  UPDATE compute_orders SET status = 'completed' WHERE user_id = YOUR_USER_ID LIMIT 1;
  ```

### 3. Test Withdrawal Flow

#### Step 1: Navigate to Withdrawal Page
- Click "Withdraw" from menu
- Should see your available balance

#### Step 2: Select Network
- Click on any network (BEP20 recommended)
- Network card should highlight with green border

#### Step 3: Enter Amount
- Enter amount ≥ $10
- Should see minimum validation

#### Step 4: Enter Wallet Address
**Test Addresses:**
- BEP20/ERC20: `0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb`
- TRC20: `TYASr5UV6HEcXatwdFQfmLVUqQQQMUxHLS`

#### Step 5: Enter PIN
- Enter your 4-digit withdrawal PIN

#### Step 6: Get Verification Code
- Click "Send Code" button
- Button should show "Sending..." then countdown "Wait 60s"
- SweetAlert popup will show the 6-digit code
- Code is also logged in console and Laravel log

#### Step 7: Enter Verification Code
- Copy the 6-digit code from popup
- Paste into "Email Verification Code" field
- Code is valid for 10 minutes

#### Step 8: Submit Withdrawal
- Click "Confirm Withdrawal"
- Should redirect to withdrawal history
- Status should be "pending"

## Expected Results

✅ **Success Case:**
- Withdrawal created with status "pending"
- Balance deducted (amount + fee)
- Email code invalidated
- Redirect to history page with success message

❌ **Error Cases:**
1. **No completed pool:** "You must complete at least one liquidity pool"
2. **Invalid PIN:** "Invalid withdrawal PIN"
3. **Invalid/Expired code:** "Invalid or expired email verification code"
4. **Invalid address:** "Invalid address for selected network"
5. **Insufficient balance:** "Insufficient balance"
6. **Amount < $10:** Validation error

## Database Verification

Check withdrawal was created:
```sql
SELECT * FROM withdrawals WHERE user_id = YOUR_USER_ID ORDER BY created_at DESC LIMIT 1;
```

Check balance was deducted:
```sql
SELECT balance FROM users WHERE id = YOUR_USER_ID;
```

## Admin Approval

To approve withdrawal (as admin):
1. Login as admin
2. Go to Admin → Withdrawals
3. Click "Approve" on pending withdrawal
4. User balance should be updated

## Notes

- **Minimum withdrawal:** $10
- **Network fees:** BEP20 ($1), TRC20 ($1), ERC20 ($10)
- **Code expiry:** 10 minutes
- **Cooldown:** 60 seconds between code requests
- **For testing:** Code is displayed in SweetAlert popup (remove in production)
