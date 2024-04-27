composer require barryvdh/laravel-debugbar --dev
echo $(pwd)
cd storage/app/public/
ls
echo $(pwd)
ls -la
cd ../../
ls
cd ..
ls
cd public/
ls
chmod -R 777 uploads/
php -i | grep php.ini
cd /usr/local/etc/php
ls
cat php.ini-production
cat php.ini-production | grep post_max
exit
