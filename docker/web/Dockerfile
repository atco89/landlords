FROM php:8.2-fpm

# Set maintainer.
MAINTAINER Aleksandar Rakić <aleksandar.rakic@yahoo.com>

# Update and install required os packages.
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxpm-dev \
    libfreetype6-dev \
    libzip-dev \
    libsodium-dev \
    libicu-dev \
    zlib1g-dev \
    nodejs \
    npm

# Configure gd extension.
RUN docker-php-ext-configure intl

RUN docker-php-ext-configure gd --with-jpeg --with-freetype

# Install php extensions.
RUN docker-php-ext-install pdo \
    pdo_mysql \
    gd \
    sodium \
    zip \
    intl

# Install composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
