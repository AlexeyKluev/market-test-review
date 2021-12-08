FROM php:7.4-fpm as fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libfreetype6-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libpq-dev \
        libonig-dev \
        graphviz \
        libssl-dev \
    && docker-php-ext-install -j$(nproc) iconv mbstring pdo_pgsql zip \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd sockets

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
 && chmod 755 /usr/bin/composer

ADD ./docker/php.ini /usr/local/etc/conf.d/php.ini

RUN groupadd -g 1000 2gis
RUN useradd -u 1000 -ms /bin/bash -g 2gis 2gis

COPY composer.* ./

RUN composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader

COPY . .

RUN chown -R 2gis ./

USER 2gis

FROM nginx:alpine as nginx

WORKDIR /var/www

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/

COPY . .
