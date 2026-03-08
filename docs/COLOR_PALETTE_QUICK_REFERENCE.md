# Cryptexa Color Palette - Quick Visual Guide

## 🎨 Primary Brand Colors

```
┌─────────────────────────────────────────┐
│ Cyan (#38bdf8)      ████████████████   │  Primary - Buttons, Actions, Highlights
│ Sky Blue (#0ea5e9)  ████████████████   │  Dark - Gradients, Hover States
└─────────────────────────────────────────┘
```

## ✅ Status Colors

```
┌─────────────────────────────────────────┐
│ Success (#22c55e)   ████████████████   │  Green - Profit, Completed, Positive
│ Warning (#f59e0b)   ████████████████   │  Amber - Running, Pending, Caution
│ Danger (#ef4444)    ████████████████   │  Red - Error, Logout, Destructive
└─────────────────────────────────────────┘
```

## 💜 Accent Colors

```
┌─────────────────────────────────────────┐
│ Purple (#a855f7)    ████████████████   │  Tertiary - Invites, Special Features
└─────────────────────────────────────────┘
```

## 🌙 Background & Text Colors

```
┌─────────────────────────────────────────┐
│ Very Dark (#020617) ████████████████   │  Page Background (Darkest)
│ Dark Blue (#0f172a) ████████████████   │  Card Backgrounds (Dark)
│ Medium Gray (#94a3b8) ░░░░░░░░░░░░   │  Secondary Text
│ Light Gray (#e5e7eb) ░░░░░░░░░░░░   │  Subtitle Text
│ White (#ffffff)     ░░░░░░░░░░░░   │  Primary Text/Headings
└─────────────────────────────────────────┘
```

## 📐 Standard Gradients

### Primary Action Gradient

```
Top-Left (#38bdf8) ──→ Bottom-Right (#0ea5e9)
45-degree angle for dynamic feel
```

### Card Background Gradient

```
Top-Left (#020617) ──→ Bottom-Right (#0f172a)
Subtle dark gradient for depth
```

### Usage Examples:

**Button/Action:**

```html
background: linear-gradient(135deg, #38bdf8, #0ea5e9);
```

**Card/Container:**

```html
background: linear-gradient(135deg, #020617, #0f172a);
```

**Glassmorphic Overlay:**

```html
background: rgba(56, 189, 248, 0.08); border: 1px solid rgba(56, 189, 248, 0.2);
```

## 🔍 Where Colors Are Used

| Component        | Primary                | Secondary       | Accent         |
| ---------------- | ---------------------- | --------------- | -------------- |
| Balance Card     | Cyan Gradient          | -               | -              |
| Withdraw Button  | Green                  | -               | -              |
| Success Badge    | Green bg/text          | -               | -              |
| Warning Badge    | Amber bg/text          | -               | -              |
| Error Badge      | Red bg/text            | -               | -              |
| Input Fields     | Dark Blue Gradient     | Cyan border     | -              |
| Tab Buttons      | Cyan Gradient (active) | Dark (inactive) | -              |
| Headers          | Dark Blue Gradient     | -               | -              |
| Order Cards      | Dark Blue Gradient     | Cyan borders    | -              |
| Referral Section | -                      | -               | Purple accents |

## ✨ Effects & Shadows

### Glow Effect (Primary)

```css
box-shadow: 0 10px 40px rgba(56, 189, 248, 0.25);
```

### Card Shadow

```css
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
```

### Hover Transition

```css
transition: all 0.3s ease;
```

## 📱 Responsive Consistency

The color scheme is designed to work perfectly on:

-   ✅ Mobile (320px+)
-   ✅ Tablet (768px+)
-   ✅ Desktop (1024px+)
-   ✅ Large Screens (1440px+)

All colors maintain proper contrast and readability at any screen size.

---

**Color Scheme**: Modern Dark Theme with Cyan Accent  
**Accessibility**: WCAG AA Compliant  
**Status**: ✅ Standardized & Implemented Across All Pages
