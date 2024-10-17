FROM php:8.2-fpm

EXPOSE 5001

RUN docker-php-ext-install pdo_mysql mysqli

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    unzip

COPY ../../src/ /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage

COPY --from=composer:2.7.9 /usr/bin/composer /usr/local/bin/composer

COPY composer.json ./
RUN composer install

CMD ["php-fpm"]