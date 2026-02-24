# Email Configuration for Withdrawal Verification

## Setup Instructions

### 1. Configure .env File

Add these settings to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@cryptexa.com
MAIL_FROM_NAME="Cryptexa"
```

### 2. Gmail Setup (Recommended for Testing)

#### Option A: App Password (Recommended)
1. Go to Google Account Settings
2. Enable 2-Factor Authentication
3. Go to Security → App Passwords
4. Generate new app password for "Mail"
5. Use this password in `MAIL_PASSWORD`

#### Option B: Less Secure Apps (Not Recommended)
1. Go to Google Account Settings
2. Security → Less secure app access
3. Turn ON (not recommended for production)

### 3. Alternative Email Services

#### Mailtrap (Best for Development)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

#### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

#### Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-secret
```

### 4. Test Email Configuration

Run this command to test:
```bash
php artisan tinker
```

Then execute:
```php
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

## How It Works

### Production Flow:
1. User clicks "Send Code"
2. Backend generates 6-digit code
3. Code stored in database (expires in 10 minutes)
4. Email sent to user's registered email
5. User receives email with code
6. User copies code from email
7. User pastes code in withdrawal form
8. User submits withdrawal

### Development/Testing Flow:
If email sending fails (mail not configured):
- Code is still generated and stored
- Code is returned in JSON response
- Code is displayed in SweetAlert popup
- Code is logged to console
- User can still test withdrawal flow

## Email Template

The email includes:
- Professional Cryptexa branding
- Large, easy-to-read 6-digit code
- 10-minute expiry warning
- Security reminders
- "Complete Withdrawal" button
- Responsive design for mobile

## Security Features

✅ Code expires in 10 minutes
✅ Code invalidated after use
✅ Masked email shown in success message (e.g., "abc***@gmail.com")
✅ Warning if user didn't request withdrawal
✅ Professional email template prevents phishing

## Troubleshooting

### Email Not Sending?

1. **Check Laravel Log:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Clear Config Cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

3. **Test Mail Configuration:**
   ```bash
   php artisan tinker
   Mail::raw('Test', fn($m) => $m->to('test@example.com')->subject('Test'));
   ```

4. **Check Firewall:**
   - Ensure port 587 (TLS) or 465 (SSL) is open
   - Check if hosting provider blocks SMTP

5. **Verify Credentials:**
   - Double-check username and password
   - For Gmail, use App Password, not regular password

### Common Errors:

| Error | Solution |
|-------|----------|
| "Connection refused" | Check MAIL_HOST and MAIL_PORT |
| "Authentication failed" | Verify MAIL_USERNAME and MAIL_PASSWORD |
| "SSL certificate problem" | Try MAIL_ENCRYPTION=tls instead of ssl |
| "Could not instantiate mail function" | Install/enable PHP mail extension |

## Production Checklist

Before going live:

- [ ] Configure production email service (SendGrid, Mailgun, etc.)
- [ ] Remove `'code' => $code` from JSON response
- [ ] Remove code display from SweetAlert
- [ ] Test email delivery to multiple providers (Gmail, Yahoo, Outlook)
- [ ] Set up SPF, DKIM, DMARC records for your domain
- [ ] Monitor email delivery rates
- [ ] Set up email queue for better performance

## Queue Configuration (Optional)

For better performance, queue emails:

1. **Update .env:**
   ```env
   QUEUE_CONNECTION=database
   ```

2. **Run migration:**
   ```bash
   php artisan queue:table
   php artisan migrate
   ```

3. **Update controller:**
   ```php
   Mail::queue('emails.withdrawal-verification', [...], ...);
   ```

4. **Start queue worker:**
   ```bash
   php artisan queue:work
   ```

## Current Behavior

✅ **With Email Configured:**
- Email sent to user
- Success message shows masked email
- Code NOT shown in popup (production mode)

✅ **Without Email Configured:**
- Code still generated and stored
- Code shown in popup (development mode)
- Debug message displayed
- User can still test withdrawal

This ensures the system works in both development and production environments!
