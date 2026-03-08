# Cryptexa Color Scheme Documentation

**Last Updated:** January 2026  
**Status:** ✅ Standardized and Implemented Across All Pages

---

## 📋 Brand Color Palette

### Primary Colors

These are the main brand colors used throughout the application.

| Color    | Hex Code  | CSS Variable     | Usage                                         | Example                                       |
| -------- | --------- | ---------------- | --------------------------------------------- | --------------------------------------------- |
| Cyan     | `#38bdf8` | `--primary`      | Primary actions, buttons, highlights, borders | Balance cards, deposit buttons, active states |
| Sky Blue | `#0ea5e9` | `--primary-dark` | Gradients, hover states, secondary accents    | Gradient backgrounds (paired with cyan)       |

### Status & Semantic Colors

| Color         | Hex Code  | CSS Variable     | Usage                            | Example                                          |
| ------------- | --------- | ---------------- | -------------------------------- | ------------------------------------------------ |
| Success Green | `#22c55e` | `--success`      | Success states, positive metrics | Profit amounts, completed badges, withdraw icons |
| Dark Green    | `#16a34a` | `--success-dark` | Success borders, darker accents  | Badge borders, accent lines                      |
| Warning Amber | `#f59e0b` | `--warning`      | Warning states, alerts           | Running order badges, caution indicators         |
| Dark Amber    | `#d97706` | `--warning-dark` | Warning borders, darker accents  | Border colors for warnings                       |
| Danger Red    | `#ef4444` | `--danger`       | Error states, dangerous actions  | Error messages, logout button                    |
| Dark Red      | `#dc2626` | `--danger-dark`  | Error borders, darker accents    | Error box borders                                |

### Accent Colors

| Color       | Hex Code  | CSS Variable    | Usage                              | Example                                 |
| ----------- | --------- | --------------- | ---------------------------------- | --------------------------------------- |
| Purple      | `#a855f7` | `--purple`      | Tertiary accents, special features | Invite/referral buttons, secondary CTAs |
| Dark Purple | `#9333ea` | `--purple-dark` | Purple borders, darker accents     | Referral badge backgrounds              |

### Neutral & Background Colors

| Color                      | Hex Code  | CSS Variable       | Usage                                | Example                        |
| -------------------------- | --------- | ------------------ | ------------------------------------ | ------------------------------ |
| Very Dark (Darkest BG)     | `#020617` | `--surface-darker` | Page background, deepest backgrounds | Main page background           |
| Dark Blue (Primary BG)     | `#0f172a` | `--surface`        | Card backgrounds, container BGs      | Card containers, info boxes    |
| Medium Gray (Text)         | `#94a3b8` | `--secondary`      | Secondary text, muted text           | Small labels, placeholder text |
| Light Gray (Alternative)   | `#D9D9D9` | `--secondary2`     | Alternate secondary color            | Rarely used, fallback option   |
| Slate (Borders)            | `#1e293b` | `--line`           | Border colors, dividers              | Input borders, separator lines |
| White (Light Text)         | `#fff`    | `--white`          | Primary text, headings               | Main content text              |
| Light Gray (Subtitle Text) | `#e5e7eb` | -                  | Secondary text, subtitles            | Smaller text, descriptions     |

---

## 🎨 Color Usage Patterns

### Gradients

Primary gradient (used throughout):

```css
background: linear-gradient(135deg, #38bdf8, #0ea5e9);
```

Dark background gradient (cards):

```css
background: linear-gradient(135deg, #020617, #0f172a);
```

### Glassmorphism Style

Used for semi-transparent overlays:

```css
background: rgba(56, 189, 248, 0.08);
border: 1px solid rgba(56, 189, 248, 0.2);
backdrop-filter: blur(10px);
```

### Shadow System

Primary shadow (glow effect):

```css
box-shadow: 0 10px 40px rgba(56, 189, 248, 0.25);
```

Dark shadow (card shadows):

```css
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
```

---

## 📱 Implementation Examples

### Balance Card (Home Page)

```html
<div
    style="background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%); 
            border-radius: 20px; padding: 20px;"
>
    <p style="color: #fff;">Available Balance</p>
    <h2 style="color: #fff;">$1,234.56</h2>
</div>
```

### Success Badge (Completed Orders)

```html
<span
    style="background: rgba(34, 197, 94, 0.15); 
            color: #22c55e; padding: 4px 12px; 
            border-radius: 999px;"
    >COMPLETED</span
>
```

### Active Tab Button

```css
.tab-btn.active {
    background: linear-gradient(135deg, #38bdf8, #0ea5e9);
    color: #020617;
}
```

### Input Field

```html
<input
    style="background: linear-gradient(135deg, #020617, #0f172a);
              border: 1px solid rgba(56, 189, 248, 0.2);
              color: #e5e7eb;"
/>
```

---

## ✅ Color Consistency Audit Results

All pages have been audited and verified to use the consistent color scheme:

### ✅ Verified Pages

-   **home.blade.php** - Primary dashboard with balanced color usage
-   **withdrawals.blade.php** - Network cards with semantic colors
-   **track.blade.php** - Order tracking with status-based colors
-   **qr-code.blade.php** - Deposit QR with proper accent colors
-   **show-plan.blade.php** - Plan cards with success color buttons
-   **choose-cryptocurrency.blade.php** - Network selection with colored badges
-   **invites.blade.php** - Referral program with accent colors
-   **partials/header.blade.php** - Navigation header with cyan accents
-   **auth/login.blade.php** - Authentication page with consistent theme
-   **auth/register.blade.php** - Registration with consistent styling

### 🎯 Color Usage Summary

-   **Cyan (#38bdf8)**: Used for primary actions, buttons, highlights, and borders
-   **Green (#22c55e)**: Used for success states and positive indicators
-   **Amber (#f59e0b)**: Used for warnings and running states
-   **Red (#ef4444)**: Used for errors and dangerous actions
-   **Purple (#a855f7)**: Used for tertiary accents and special features
-   **Dark Backgrounds**: Consistent use of #020617 and #0f172a
-   **Text**: Proper contrast with #e5e7eb for light text on dark backgrounds

---

## 🔄 CSS Variables (Updated in styles.css)

All colors are defined in `:root` variables for easy maintenance:

```css
:root {
    /* CORE COLORS */
    --primary: #38bdf8; /* Cyan */
    --primary-dark: #0ea5e9; /* Sky Blue */
    --interactive: #38bdf8; /* Cyan */
    --white: #fff;
    --secondary: #94a3b8; /* Medium Gray */
    --secondary2: #d9d9d9; /* Light Gray */

    /* STATUS COLORS */
    --success: #22c55e; /* Green */
    --success-dark: #16a34a; /* Dark Green */
    --warning: #f59e0b; /* Amber */
    --warning-dark: #d97706; /* Dark Amber */
    --danger: #ef4444; /* Red */
    --danger-dark: #dc2626; /* Dark Red */

    /* ACCENT COLORS */
    --purple: #a855f7; /* Purple */
    --purple-dark: #9333ea; /* Dark Purple */

    /* BACKGROUNDS & SURFACES */
    --surface: #0f172a; /* Dark Blue */
    --surface-darker: #020617; /* Very Dark */
    --line: #1e293b; /* Slate - Borders */
    --menuDark: #1e293b; /* Dark menu */
    --backdrop: #020617; /* Very dark backdrop */
}
```

---

## 📝 Guidelines for New Development

### When Adding New Features:

1. **Use CSS variables** from `:root` instead of hardcoding colors
2. **Follow existing patterns** for gradients and shadows
3. **Maintain semantic color usage**:
    - Green = success, positive actions
    - Amber = warnings, pending states
    - Red = errors, destructive actions
    - Cyan = primary actions, highlights
    - Purple = tertiary features, special actions
4. **Test contrast** - Ensure text is readable on all backgrounds
5. **Use glassmorphism** for overlays and semi-transparent elements

### Color Contrast Standards:

-   Light text (#e5e7eb, #fff) on dark backgrounds (#020617, #0f172a) ✅
-   Colored text on colored backgrounds must maintain WCAG AA compliance
-   Use opacity to adjust color intensity rather than changing hues

---

## 🎓 Quick Reference

**Primary Actions**: Cyan gradients (#38bdf8 → #0ea5e9)  
**Success States**: Green (#22c55e)  
**Warning States**: Amber (#f59e0b)  
**Error States**: Red (#ef4444)  
**Special Actions**: Purple (#a855f7)  
**Backgrounds**: Dark Blue/Very Dark (#0f172a / #020617)  
**Text**: Light Gray/White (#e5e7eb / #fff)

---

## 📊 Color Scheme Version History

| Version | Date     | Changes                                                                                  |
| ------- | -------- | ---------------------------------------------------------------------------------------- |
| 2.0     | Jan 2026 | Updated to cyan/blue modern scheme, added semantic colors, standardized across all pages |
| 1.0     | Original | Legacy green scheme (#25c866) - DEPRECATED                                               |

---

**Status**: ✅ All pages standardized and consistent  
**Last Verified**: January 2026  
**Maintained By**: Development Team
