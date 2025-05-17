FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git && \
    docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite