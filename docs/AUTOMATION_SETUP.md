# Automation Setup Guide

## Overview
The application has automated tasks that run every 5 minutes to handle:
- Pool completion and payouts
- Compound interest processing
- Deposit status checks
- Withdrawal reminders
- Database cleanup

## Setup Instructions

### For Localhost (Windows)

1. **Open Command Prompt/PowerShell** in your project directory

2. **Run the scheduler** (keep this running):
```bash
php artisan schedule:work
```

This will run the scheduler every minute and execute tasks as scheduled.

**Alternative**: Run manually when needed:
```bash
php artisan automation:run
```

### For Production (Linux/Ubuntu)

1. **Add Cron Job** - Edit crontab:
```bash
crontab -e
```

2. **Add this line** (replace `/path/to/project` with your actual path):
```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

This runs Laravel's scheduler every minute, which then executes tasks based on the schedule.

### For Production (Shared Hosting)

If you don't have SSH access:

1. **Use Hosting Control Panel** (cPanel, Plesk, etc.)
2. **Add Cron Job** with:
   - Command: `/usr/bin/php /home/username/public_html/artisan schedule:run`
   - Frequency: Every minute (`* * * * *`)

### Verify It's Working

1. **Check logs**:
```bash
tail -f storage/logs/laravel.log
```

2. **Run manually to test**:
```bash
php artisan automation:run
```

3. **Check scheduled tasks**:
```bash
php artisan schedule:list
```

## What Gets Automated

| Task | Frequency | Description |
|------|-----------|-------------|
| Pool Completion | Every 5 min | Auto-completes expired pools and pays users |
| Compound Interest | Every 5 min | Processes daily compound for active pools |
| Deposit Check | Every 5 min | Auto-approves pending deposits (localhost) |
| Withdrawal Reminders | Every 5 min | Auto-rejects old pending withdrawals |
| Database Cleanup | Every 5 min | Removes old notifications and unverified users |

## Troubleshooting

**Scheduler not running?**
- Ensure cron job is added correctly
- Check PHP path: `which php`
- Verify artisan file permissions: `chmod +x artisan`

**Tasks not executing?**
- Check `storage/logs/laravel.log` for errors
- Ensure database connection is working
- Run `php artisan automation:run` manually to test

## Manual Execution

You can always run automations manually:
```bash
php artisan automation:run
```

Or via browser (localhost only):
```
http://localhost:8000/automation/run
```
