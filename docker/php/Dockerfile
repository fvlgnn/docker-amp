FROM composer:2 AS composer

FROM php:8.4-fpm-alpine

ARG XDEBUG=0
ARG COMPOSER=0

RUN set -eux; \
    apk add --no-cache bash fcgi icu-libs libjpeg-turbo libpng libzip freetype; \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS freetype-dev icu-dev libjpeg-turbo-dev libpng-dev libzip-dev; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" gd intl mysqli opcache pdo_mysql zip; \
    if [ "$XDEBUG" = "1" ]; then pecl install xdebug && docker-php-ext-enable xdebug; fi; \
    apk del .build-deps

COPY --from=composer /usr/bin/composer /tmp/composer

RUN if [ "$COMPOSER" = "1" ]; then \
        apk add --no-cache git unzip; \
        mv /tmp/composer /usr/local/bin/composer; \
    else rm /tmp/composer; fi

COPY php.ini /usr/local/etc/php/conf.d/zz-app.ini

WORKDIR /src

CMD ["php-fpm"]
