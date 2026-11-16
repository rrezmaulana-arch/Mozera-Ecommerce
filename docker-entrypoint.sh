#!/bin/bash
set -e

# 1. Bind Apache to the PORT environment variable provided by Google Cloud Run (default: 8080)
PORT=${PORT:-8080}
sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 2. Ensure storage and database folders have proper permissions for www-data
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
if [ -f /var/www/html/database/database.sqlite ]; then
    chmod 664 /var/www/html/database/database.sqlite
fi

# 3. Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# 4. Run database migrations and seeders if sqlite database is fresh/empty
if [ ! -s /var/www/html/database/database.sqlite ]; then
    php artisan migrate --force --seed
fi

# 5. Optimize caches for production
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "=== MOZÉRA Storefront Ready on Port $PORT (Google Cloud Run) ==="

# 6. Execute CMD
exec "$@"
