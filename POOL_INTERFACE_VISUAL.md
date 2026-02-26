# Pool Activation Interface - Visual Layout

## Desktop View (> 768px)

```
┌─────────────────────────────────────────────────────────────┐
│  ← Back              POOL NAME                              │ HEADER
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                                                               │
│  POOL NAME                                                    │ HERO
│  Pool description text here...                                │
│                                                               │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  💰 Pool Price          │  ⏱️ Duration                       │
│  $500.00                │  1440 min (1 Days)                 │ DETAILS
│                         │                                     │
│  📈 Daily Return (Fixed)                                     │
│  2.5%                                                         │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  💡 Pool Features                                            │
│  ✓ Compound Interest                                         │ FEATURES
│  ✓ Auto-Completion                                           │
│  ✓ Real-time Tracking                                        │
│  ✓ Secure & Audited                                          │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  💼 Your Balance                           $5,000.00         │ BALANCE
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  💵 INVESTMENT AMOUNT (USD)                                  │
│                                                               │
│  ┌─────────────────────────────────────────────────────┐   │
│  │  $ 1000.00                                           │   │ INPUT
│  └─────────────────────────────────────────────────────┘   │
│                                                               │
│  Min: $500.00                          Max: $5,000.00        │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  [$500]  [$1000]  [$2500]  [$5000]  [MAX]                   │ QUICK
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  📊 Projected Returns                                        │
│                                                               │
│  Investment                                    $1,000.00     │
│  Expected Profit                               $1,097.57     │ RETURNS
│  ─────────────────────────────────────────────────────       │
│  Total Return                                  $2,097.57     │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                    🚀 Activate Pool                          │ BUTTON
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  🔒 Locked Funds - Your investment will be locked until      │ INFO
│  the plan completes                                           │
└─────────────────────────────────────────────────────────────┘
```

## Mobile View (< 768px)

```
┌───────────────────────────────┐
│  ← Back    POOL NAME          │ HEADER
└───────────────────────────────┘

┌───────────────────────────────┐
│  POOL NAME                     │ HERO
│  Pool description...           │
└───────────────────────────────┘

┌───────────────────────────────┐
│  💰 Pool Price                │
│  $500.00                       │
├───────────────────────────────┤ DETAILS
│  ⏱️ Duration                  │ (STACKED)
│  1440 min (1 Days)             │
├───────────────────────────────┤
│  📈 Daily Return               │
│  2.5%                          │
└───────────────────────────────┘

┌───────────────────────────────┐
│  💡 Pool Features             │
│  ✓ Compound Interest           │ FEATURES
│  ✓ Auto-Completion             │
│  ✓ Real-time Tracking          │
│  ✓ Secure & Audited            │
└───────────────────────────────┘

┌───────────────────────────────┐
│  💼 Your Balance  $5,000.00   │ BALANCE
└───────────────────────────────┘

┌───────────────────────────────┐
│  💵 INVESTMENT AMOUNT          │
│  ┌───────────────────────────┐│
│  │  $ 1000.00                 ││ INPUT
│  └───────────────────────────┘│
│  Min: $500  Max: $5,000        │
└───────────────────────────────┘

┌───────────────────────────────┐
│  [$500] [$1000] [$2500]       │ QUICK
│  [$5000]        [MAX]          │ (3 COLS)
└───────────────────────────────┘

┌───────────────────────────────┐
│  📊 Projected Returns          │
│  Investment      $1,000.00     │
│  Profit          $1,097.57     │ RETURNS
│  ──────────────────────        │
│  Total           $2,097.57     │
└───────────────────────────────┘

┌───────────────────────────────┐
│      🚀 Activate Pool          │ BUTTON
└───────────────────────────────┘

┌───────────────────────────────┐
│  🔒 Locked Funds - Investment  │ INFO
│  locked until completion       │
└───────────────────────────────┘
```

## Color Scheme

### Background Colors:
- **Main Background**: Dark gradient (#020617 → #0f172a)
- **Card Background**: Cyan gradient (rgba(56,189,248,0.08) → rgba(56,189,248,0.02))
- **Returns Card**: Green gradient (rgba(34,197,94,0.08) → rgba(34,197,94,0.02))
- **Balance Card**: Purple gradient (rgba(168,85,247,0.08) → rgba(168,85,247,0.02))
- **Features Card**: Yellow gradient (rgba(251,191,36,0.08) → rgba(251,191,36,0.02))

### Text Colors:
- **Primary Text**: #e5e7eb (light gray)
- **Secondary Text**: #94a3b8 (slate gray)
- **Accent Cyan**: #38bdf8
- **Accent Green**: #22c55e
- **Accent Purple**: #a855f7
- **Accent Yellow**: #fbbf24
- **Error Red**: #ef4444

### Border Colors:
- **Cyan Border**: rgba(56,189,248,0.15)
- **Green Border**: rgba(34,197,94,0.15)
- **Purple Border**: rgba(168,85,247,0.15)
- **Yellow Border**: rgba(251,191,36,0.15)

## Interactive States

### Input Field:
```
Normal:   border: 2px solid rgba(56,189,248,0.2)
          background: rgba(15,23,42,0.6)

Focus:    border: 2px solid rgba(56,189,248,0.5)
          background: rgba(15,23,42,0.8)
```

### Quick Amount Buttons:
```
Normal:   background: rgba(56,189,248,0.1)
          border: 1px solid rgba(56,189,248,0.2)

Hover:    background: rgba(56,189,248,0.15)
```

### MAX Button:
```
Normal:   background: rgba(168,85,247,0.15)
          border: 1px solid rgba(168,85,247,0.3)

Hover:    background: rgba(168,85,247,0.2)
```

### Activate Button:
```
Normal:   background: linear-gradient(135deg, rgba(34,197,94,0.2), rgba(34,197,94,0.1))
          border: 1px solid rgba(34,197,94,0.3)
          shadow: 0 0 30px rgba(34,197,94,0.0)

Hover:    background: linear-gradient(135deg, rgba(34,197,94,0.3), rgba(34,197,94,0.15))
          shadow: 0 0 30px rgba(34,197,94,0.3)
```

## Animations

### Entrance Animations:
- **Hero Section**: slideDown 0.6s ease
- **Details Card**: slideUp 0.6s ease 0.1s
- **Features Card**: slideUp 0.6s ease 0.2s
- **Form Section**: slideUp 0.6s ease 0.3s

### Interaction Animations:
- **All Transitions**: 0.3s ease
- **Button Hover**: 0.2s ease
- **Input Focus**: 0.3s ease

## Typography

### Font Sizes (Desktop):
- **H1 (Pool Name)**: 32px, weight: 900
- **H3 (Stats)**: 24px, weight: 900
- **H5 (Section Titles)**: 16px, weight: 700
- **H6 (Returns Title)**: 14px, weight: 700
- **Input**: 24px, weight: 700
- **Labels**: 13px, weight: 600, uppercase
- **Body Text**: 14px
- **Small Text**: 12px

### Font Sizes (Mobile):
- **H1**: 24px
- **H3**: 20px
- **Input**: 20px
- **Buttons**: 11px

## Spacing

### Padding:
- **Cards**: 24px (16px on mobile)
- **Input**: 16px (12px on mobile)
- **Buttons**: 16px

### Margins:
- **Section Spacing**: 24px (18px on mobile)
- **Element Spacing**: 16px (12px on mobile)
- **Small Spacing**: 8px

### Gaps:
- **Grid Gap**: 16px (12px on mobile)
- **Button Gap**: 8px (6px on mobile)

## User Interaction Flow

1. **Page Load**
   - All sections animate in sequentially
   - Balance displays user's available funds
   - Input field is empty, waiting for user input

2. **User Enters Amount**
   - Types in input field OR clicks quick button
   - Returns card appears with calculations
   - All values update in real-time

3. **User Clicks MAX**
   - Input fills with full balance
   - Returns card shows maximum possible profit
   - User can still edit the amount

4. **User Submits**
   - Form validates amount
   - If valid: Pool activates, redirects to home
   - If invalid: Error message appears, input preserved

5. **Error Handling**
   - Red error card appears at top
   - Input value is preserved
   - Returns card auto-calculates on reload
   - User can correct and resubmit
