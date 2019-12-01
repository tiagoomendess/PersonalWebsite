echo "#########################"
echo "#   Starting deploy!"   #
echo "#########################"

echo "--- Taking application down ------------"
php artisan down

git reset --hard
git pull
php artisan cache:clear

echo "--- Composer install -----------"
composer install

echo "--- NPM nnstall ------------"
npm install

echo "--- Compiling sccs and js ------------"
npm run production

echo "--- Running migrations ------------"
php artisan migrate

echo "--- Dealing with permissions ------------"
chmod 755 -R ../meusite/
chown www-data ../meusite/ -R

echo "--- Application Up! ------------"
php artisan up

echo "#################"
echo "#   Finished!   #"
echo "#################"