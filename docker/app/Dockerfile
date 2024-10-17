FROM php:8.2-fpm

EXPOSE 5001

COPY ./docker/app/php.ini /usr/local/etc/php/php.ini
RUN mkdir -p /var/log && touch /var/log/php_errors.log && chmod 666 /var/log/php_errors.log

RUN docker-php-ext-install pdo_mysql mysqli

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    unzip

COPY ../../src/ /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage

COPY --from=composer:2.7.9 /usr/bin/composer /usr/local/bin/composer

RUN composer install

CMD ["php-fpm"]