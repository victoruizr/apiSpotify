#!/usr/bin/env bash
cat /etc/secret/.env > /var/www/html/.env
cat /etc/credentials/credentials.json > /var/www/html/credentials.json
cd /var/www/html && sudo /usr/local/bin/php artisan cache:clear
cd /var/www/html && sudo /usr/local/bin/php artisan config:clear
cd /var/www/html && sudo /usr/local/bin/php artisan migrate
apachectl -D FOREGROUND

