# 🚀 WITHDRAWAL SYSTEM - QUICK TEST GUIDE

## ✅ Prerequisites Checklist
- [ ] Run: `php artisan migrate:fresh --seed`
- [ ] Set withdrawal PIN in Settings (e.g., 1234)
- [ ] Complete at least one pool OR run SQL:
  ```sql
  UPDATE compute_orders SET status = 'completed' WHERE user_id = 1 LIMIT 1;
  ```

## 🎯 How It Works

### Email Flow (Production):
1. User clicks "Send Code" button
2. System generates 6-digit code
3. Code stored in database (expires in 10 minutes)
4. **Email sent to user's registered email address**
5. User opens email and copies the 6-digit code
6. User pastes code into "Email Verification Code" field
7. User submits withdrawal

### Development Mode (Email Not Configured):
- Code is shown in popup for testing
- Code is also logged to console
- User can still complete withdrawal flow

## 📧 Email Setup

To enable real email sending, configure `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

See `EMAIL_SETUP.md` for detailed configuration.

## 🎯 Test Data

### Test Wallet Addresses:
```
BEP20/ERC20: 0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb
TRC20:       TYASr5UV6HEcXatwdFQfmLVUqQQQMUxHLS
```

### Test Values:
- Amount: $10 (minimum)
- PIN: 1234 (your set PIN)
- Code: Will be shown in popup after clicking "Send Code"

## 📋 Test Steps (30 seconds)

1. **Navigate:** Click "Withdraw" from menu
2. **Network:** Click "USDT BEP20" (green card)
3. **Amount:** Enter `10`
4. **Address:** Paste `0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb`
5. **PIN:** Enter `1234`
6. **Code:** Click "Send Code" → Copy code from popup → Paste
7. **Submit:** Click "Confirm Withdrawal"

## ✨ What to Expect

### ✅ Success Flow:
1. "Send Code" button → "Sending..." → Popup with code → "Wait 60s"
2. Code auto-copied to clipboard (or shown in popup)
3. Submit → Success message → Redirect to history
4. Balance deducted (amount + $1 fee for BEP20)
5. Withdrawal status: "pending"

### ❌ Common Errors:
| Error | Solution |
|-------|----------|
| "Withdrawal Locked" | Complete a pool first |
| "Invalid PIN" | Check your withdrawal PIN in settings |
| "Invalid code" | Click "Send Code" again (code expires in 10 min) |
| "Insufficient balance" | Add funds or reduce amount |
| "Invalid address" | Use correct format for selected network |

## 🔍 Verify in Database

```sql
-- Check withdrawal created
SELECT * FROM withdrawals WHERE user_id = 1 ORDER BY created_at DESC LIMIT 1;

-- Check balance deducted
SELECT balance FROM users WHERE id = 1;

-- Check verification code stored
SELECT email_verification_code, email_verification_expires_at FROM users WHERE id = 1;
```

## 🎨 UI Features to Test

- [ ] Balance card shows correct amount
- [ ] Network cards highlight on click (green border)
- [ ] Amount input validates minimum $10
- [ ] "Send Code" button has 60s cooldown
- [ ] Code input accepts only numbers
- [ ] Submit button has gradient and hover effect
- [ ] Info boxes show processing time and security notice
- [ ] Mobile responsive (test at 375px width)

## 🔐 Security Features

✅ Withdrawal PIN required (4 digits)
✅ Email verification code (6 digits, 10 min expiry)
✅ Address format validation per network
✅ Balance check before processing
✅ Code invalidated after use
✅ 60-second cooldown between code requests
✅ Pool completion requirement

## 📱 Mobile Test

Resize browser to 375px width and verify:
- [ ] All elements fit without horizontal scroll
- [ ] Buttons are easily tappable (min 44px)
- [ ] Text is readable (min 12px)
- [ ] Cards stack properly
- [ ] Form inputs are full width

## 🎉 Success Criteria

✅ Code sent and displayed in popup
✅ Code accepted and withdrawal created
✅ Balance deducted correctly
✅ Redirected to history page
✅ Withdrawal shows as "pending"
✅ No console errors
✅ Mobile responsive works

## 🐛 Debug Tips

**Code not sending?**
- Check Laravel log: `storage/logs/laravel.log`
- Check browser console for errors
- Verify route exists: `php artisan route:list | findstr withdraw`

**Code not working?**
- Check expiry time in database
- Verify code matches exactly (6 digits)
- Try sending new code

**Balance not deducted?**
- Check withdrawal record created
- Verify transaction completed
- Check for database errors in log

## 📞 Support

If issues persist:
1. Check `storage/logs/laravel.log`
2. Check browser console (F12)
3. Verify database migrations ran
4. Clear cache: `php artisan cache:clear`
