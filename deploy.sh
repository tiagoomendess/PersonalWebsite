echo "#########################"
echo "#   Starting deploy!"   #"
echo "#########################"

echo "\n--- Taking application down ------------"
php artisan down

echo "\n--- Get Code -----------"
git reset --hard
git pull

echo "\n--- Clear Cache -----------"
php artisan cache:clear

echo "\n--- Composer install -----------"
composer install

echo "\n--- NPM nnstall ------------"
npm install

echo "\n--- Compiling sccs and js ------------"
npm run production

echo "\n--- Running migrations ------------"
php artisan migrate --env=production

echo "\n--- Dealing with permissions ------------"
chmod 755 -R ../meusite/
chown www-data ../meusite/ -R

echo "\n--- Application Up! ------------"
php artisan up

echo "#################"
echo "#   Finished!   #"
echo "#################"