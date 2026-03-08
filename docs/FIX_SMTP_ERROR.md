# Fix Gmail SMTP Authentication Error 535

## Problem
Error: "Failed to authenticate on SMTP server with code 535"

## Cause
Gmail is rejecting the authentication credentials.

## Solutions

### Option 1: Generate New Gmail App Password (RECOMMENDED)

1. **Enable 2-Step Verification**
   - Go to: https://myaccount.google.com/security
   - Click "2-Step Verification"
   - Follow steps to enable it

2. **Generate App Password**
   - Go to: https://myaccount.google.com/apppasswords
   - Select "Mail" and "Windows Computer" (or Other)
   - Click "Generate"
   - Copy the 16-character password (no spaces)

3. **Update .env file**
   ```
   MAIL_PASSWORD=your-new-16-char-password
   ```

4. **Clear config cache**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

### Option 2: Use Mailtrap (For Testing)

1. **Sign up at Mailtrap.io** (free)
   - Go to: https://mailtrap.io

2. **Get credentials from inbox**
   - Copy Host, Port, Username, Password

3. **Update .env**
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your-mailtrap-username
   MAIL_PASSWORD=your-mailtrap-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@cryptexa.com
   MAIL_FROM_NAME="CRYPTEXA"
   ```

### Option 3: Disable Email Temporarily

Update .env to use log driver (emails saved to storage/logs):
```
MAIL_MAILER=log
```

### Option 4: Use Different SMTP Provider

**SendGrid, Mailgun, Amazon SES, etc.**

## Quick Test

After fixing, test with:
```bash
php artisan tinker
Mail::raw('Test email', function($msg) { $msg->to('test@example.com')->subject('Test'); });
```

## Current Settings
- Host: smtp.gmail.com
- Port: 587
- Encryption: tls
- Username: amosnyoni186@gmail.com
- Password: dkxadvktvbanqzqd (might be invalid)

## Recommended Action
Generate a new Gmail App Password and update MAIL_PASSWORD in .env
