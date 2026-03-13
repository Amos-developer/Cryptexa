# Cryptexa - Deployment Guide for Linode

## Prerequisites
- Ubuntu 22.04 LTS
- PHP 8.2+
- MySQL 8.0+
- Nginx
- Composer
- Supervisor
- Git

## Initial Server Setup

### 1. Update System
```bash
sudo apt update && sudo apt upgrade -y
```

### 2. Install Required Packages
```bash
sudo apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-curl php8.2-zip php8.2-gd nginx mysql-server composer git supervisor
```

### 3. Configure MySQL
```bash
sudo mysql_secure_installation
sudo mysql -u root -p
```

```sql
CREATE DATABASE cryptexa_production;
CREATE USER 'cryptexa_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON cryptexa_production.* TO 'cryptexa_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 4. Clone Repository
```bash
cd /var/www
sudo git clone https://github.com/yourusername/cryptexa.git
cd cryptexa
```

### 5. Set Permissions
```bash
sudo chown -R www-data:www-data /var/www/cryptexa
sudo chmod -R 755 /var/www/cryptexa
sudo chmod -R 775 /var/www/cryptexa/storage
sudo chmod -R 775 /var/www/cryptexa/bootstrap/cache
```

### 6. Install Dependencies
```bash
composer install --no-dev --optimize-autoloader
```

### 7. Configure Environment
```bash
cp .env.production.example .env
nano .env
```

Update these values:
- `APP_URL` - Your domain
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `NOWPAYMENTS_API_KEY`, `NOWPAYMENTS_IPN_SECRET`

```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

### 8. Configure Nginx
```bash
sudo nano /etc/nginx/sites-available/cryptexa
```

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/cryptexa/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/cryptexa /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 9. Setup SSL with Let's Encrypt
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 10. Setup Cron Job
```bash
sudo crontab -e -u www-data
```

Add:
```
* * * * * cd /var/www/cryptexa && php artisan schedule:run >> /dev/null 2>&1
```

### 11. Setup Queue Worker with Supervisor
```bash
sudo cp /var/www/cryptexa/supervisor-cryptexa-worker.conf /etc/supervisor/conf.d/
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start cryptexa-worker:*
```

### 12. Check Status
```bash
sudo supervisorctl status
php artisan queue:work --once  # Test queue
```

## Deployment Updates

When pushing new code:

```bash
cd /var/www/cryptexa
sudo -u www-data bash deploy.sh
```

## Monitoring

### Check Queue Workers
```bash
sudo supervisorctl status cryptexa-worker:*
```

### View Logs
```bash
tail -f storage/logs/laravel.log
tail -f storage/logs/worker.log
```

### Restart Services
```bash
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm
sudo supervisorctl restart cryptexa-worker:*
```

## Security Checklist
- [ ] Set `APP_DEBUG=false` in production
- [ ] Use strong `APP_KEY`
- [ ] Secure database credentials
- [ ] Enable SSL/HTTPS
- [ ] Configure firewall (UFW)
- [ ] Regular backups
- [ ] Keep system updated

## Backup Strategy
```bash
# Database backup
mysqldump -u cryptexa_user -p cryptexa_production > backup_$(date +%Y%m%d).sql

# Files backup
tar -czf cryptexa_backup_$(date +%Y%m%d).tar.gz /var/www/cryptexa
```

## Troubleshooting

### Permission Issues
```bash
sudo chown -R www-data:www-data /var/www/cryptexa
sudo chmod -R 755 /var/www/cryptexa
sudo chmod -R 775 /var/www/cryptexa/storage
```

### Clear All Caches
```bash
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Queue Not Processing
```bash
sudo supervisorctl restart cryptexa-worker:*
php artisan queue:restart
```
