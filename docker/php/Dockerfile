FROM php:7.4-apache

# Instalamos dependencias del sistema y extensiones PHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip \
    zip \
    zlib1g-dev \
    libpng-dev \
    && docker-php-ext-install intl pdo_mysql gd

# Habilitamos mod_rewrite para que funcionen las rutas de CakePHP
RUN a2enmod rewrite

# Instalamos Composer dentro del contenedor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
