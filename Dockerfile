FROM bref/php-74-fpm
COPY . /var/task
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader \
   && composer dump-autoload \
   && php artisan optimize && php artisan config:cache \
   && php artisan config:clear
   
CMD [ "public/index.php" ]