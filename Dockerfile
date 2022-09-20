FROM  php:8-fpm-alpine

RUN apk add composer

# Tweak configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN sed -i -e '/post_max_size =/ s/= .*/= 512M/' "$PHP_INI_DIR/php.ini"
RUN sed -i -e '/upload_max_filesize =/ s/= .*/= 512M/' "$PHP_INI_DIR/php.ini"

COPY src .

RUN composer install --no-dev --optimize-autoloader
