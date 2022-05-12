FROM composer:latest AS composer
COPY . .
RUN composer install --no-dev

FROM  php:8-apache
RUN docker-php-ext-install pdo_mysql
COPY --from=composer /app /var/www/html