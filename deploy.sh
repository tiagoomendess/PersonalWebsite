echo "Starting deploy!"

php artisan down
git reset --hard
git pull
php artisan cache:clear
composer install
npm run production
php artisan migrate
chmod 755 -R ../meusite/
chown www-data ../meusite/ -R
php artisan up

echo "Finished!"