# Pool Amount Input - Quick Reference Guide

## 🎯 What Changed?

**BEFORE**: Users could only activate pools with fixed prices
**AFTER**: Users can now invest custom amounts (minimum = pool price, maximum = user balance)

## 📱 New UI Components

### 1. Balance Display
```
💼 Your Balance                    $5,000.00
```
- Shows user's current available balance
- Purple gradient card
- Always visible at top of form

### 2. Amount Input Field
```
💵 INVESTMENT AMOUNT (USD)
┌─────────────────────────────┐
│  $ 1000.00                   │
└─────────────────────────────┘
Min: $500.00    Max: $5,000.00
```
- Large, prominent input with $ prefix
- Real-time validation
- Min/Max indicators

### 3. Quick Amount Buttons
```
[$500]  [$1000]  [$2500]  [$5000]  [MAX]
```
- 5 preset amounts for quick selection
- MAX button fills with full balance
- Responsive grid (3 cols mobile, 5 cols desktop)

### 4. Projected Returns Calculator
```
📊 Projected Returns

Investment                    $1,000.00
Expected Profit               $1,097.57
─────────────────────────────────────
Total Return                  $2,097.57
```
- Auto-calculates compound interest
- Updates in real-time
- Only shows when valid amount entered

## 🔧 Technical Implementation

### Controller Changes
**File**: `app/Http/Controllers/ComputeController.php`

```php
// OLD
public function activatePool(int $id)
{
    $principal = $plan->price;
    // ...
}

// NEW
public function activatePool(Request $request, int $id)
{
    $request->validate([
        'amount' => ['required', 'numeric', 'min:' . $plan->price],
    ]);
    
    $amount = $request->input('amount');
    $principal = $amount;
    // ...
}
```

### View Changes
**File**: `resources/views/show-plan.blade.php`

**Added:**
- User balance display
- Amount input field with validation
- 5 quick amount buttons
- Real-time returns calculator
- JavaScript calculation functions
- Error message display
- Mobile-responsive styles

## 💡 Key Features

### ✅ Real-time Calculations
- Compound interest formula: `finalAmount = principal × (1 + dailyProfit/100)^days`
- Updates instantly as user types
- Accurate to 2 decimal places

### ✅ Smart Validation
- **Client-side**: HTML5 validation (min, max, required)
- **Server-side**: Laravel validation rules
- **Balance check**: Ensures user has sufficient funds
- **Running pool check**: One active pool per user

### ✅ User Experience
- Auto-fills on quick button click
- Preserves input on validation errors
- Auto-calculates on page reload
- Smooth animations and transitions
- Clear error messages

### ✅ Mobile-First Design
- Responsive grid layouts
- Touch-friendly buttons
- Optimized font sizes
- Adaptive spacing

## 🎨 Design System

### Colors
| Element | Color | Usage |
|---------|-------|-------|
| Cyan | #38bdf8 | Input fields, quick buttons |
| Green | #22c55e | Returns, activate button |
| Purple | #a855f7 | Balance, MAX button |
| Yellow | #fbbf24 | Features section |
| Red | #ef4444 | Error messages |

### Spacing
| Size | Desktop | Mobile |
|------|---------|--------|
| Card Padding | 24px | 16px |
| Section Margin | 24px | 18px |
| Grid Gap | 16px | 12px |
| Button Gap | 8px | 6px |

### Typography
| Element | Desktop | Mobile |
|---------|---------|--------|
| H1 | 32px | 24px |
| H3 | 24px | 20px |
| Input | 24px | 20px |
| Button | 12px | 11px |

## 🚀 Usage Examples

### Example 1: Minimum Investment
```
Pool Price: $500
User Balance: $5,000
User Input: $500
Expected Profit: $548.79 (30 days @ 2.5%)
Total Return: $1,048.79
```

### Example 2: Custom Investment
```
Pool Price: $500
User Balance: $5,000
User Input: $2,000
Expected Profit: $2,195.14 (30 days @ 2.5%)
Total Return: $4,195.14
```

### Example 3: Maximum Investment
```
Pool Price: $500
User Balance: $5,000
User Input: $5,000 (MAX)
Expected Profit: $5,487.85 (30 days @ 2.5%)
Total Return: $10,487.85
```

## ⚠️ Validation Rules

### Client-Side
- Type: number
- Min: Pool price
- Max: User balance
- Required: Yes
- Step: 0.01

### Server-Side
```php
'amount' => [
    'required',
    'numeric',
    'min:' . $plan->price
]
```

### Additional Checks
- User balance >= amount
- No running pools (one active pool per user)
- Pool exists and is active

## 🐛 Error Handling

### Insufficient Balance
```
⚠️ Insufficient balance.
```
- Shown when amount > user balance
- User redirected back to form
- Input value preserved

### Below Minimum
```
⚠️ The amount must be at least $500.00
```
- Shown when amount < pool price
- User redirected back to form
- Input value preserved

### Already Active Pool
```
⚠️ You already have an active pool. Please wait until it completes before activating another.
```
- Shown when user has running pool
- User redirected back to form

## 📊 Calculation Formula

### Compound Interest
```javascript
// Variables
principal = user input amount
dailyProfit = pool daily profit percentage
days = pool duration in days

// Calculation
finalAmount = principal × (1 + dailyProfit/100)^days
expectedProfit = finalAmount - principal
totalReturn = finalAmount
```

### Example Calculation
```
Principal: $1,000
Daily Profit: 2.5%
Days: 30

Step 1: Convert percentage to decimal
2.5% = 0.025

Step 2: Calculate growth factor
1 + 0.025 = 1.025

Step 3: Apply compound formula
$1,000 × (1.025)^30 = $2,097.57

Step 4: Calculate profit
$2,097.57 - $1,000 = $1,097.57

Result:
- Investment: $1,000.00
- Expected Profit: $1,097.57
- Total Return: $2,097.57
```

## 🔄 User Flow

```
1. User navigates to pool details page
   ↓
2. User sees balance: $5,000.00
   ↓
3. User enters amount: $1,000 OR clicks quick button
   ↓
4. Returns calculator shows projected profit
   ↓
5. User clicks "Activate Pool"
   ↓
6. System validates amount
   ↓
7a. Valid: Pool activates, balance deducted, redirect to home
7b. Invalid: Error shown, input preserved, user can correct
```

## 📝 Testing Checklist

- [ ] Input accepts valid numbers
- [ ] Input rejects invalid characters
- [ ] Min validation works (< pool price)
- [ ] Max validation works (> user balance)
- [ ] Quick buttons set correct amounts
- [ ] MAX button uses full balance
- [ ] Calculator updates in real-time
- [ ] Calculations are accurate
- [ ] Error messages display correctly
- [ ] Old values persist after errors
- [ ] Mobile layout is responsive
- [ ] Animations work smoothly
- [ ] Pool activates with custom amount
- [ ] Balance deducts correctly
- [ ] Notifications show correct amounts

## 🎓 Best Practices

### For Users:
1. Check your balance before investing
2. Use quick buttons for common amounts
3. Review projected returns before activating
4. Start with minimum amount to test
5. Use MAX button for full investment

### For Developers:
1. Always validate on both client and server
2. Use transactions for atomic operations
3. Preserve user input on errors
4. Show clear error messages
5. Test with edge cases (min, max, decimals)

## 📚 Related Files

- `resources/views/show-plan.blade.php` - Main view
- `app/Http/Controllers/ComputeController.php` - Controller logic
- `routes/web.php` - Route definition (line 169-170)
- `app/Models/ComputeOrder.php` - Order model
- `app/Models/ComputePlan.php` - Plan model

## 🔗 Related Features

- Pool tracking (`/track`)
- Balance management (`/account/settings`)
- Deposit system (`/deposit`)
- Withdrawal system (`/withdraw`)
- Notifications (`/notifications`)

## 📞 Support

For issues or questions:
1. Check validation error messages
2. Verify user balance is sufficient
3. Ensure no active pools exist
4. Check browser console for JS errors
5. Review server logs for validation errors
