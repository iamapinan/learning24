FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    imagemagick \
    libmagickwand-dev


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install imagick
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip
RUN docker-php-ext-enable imagick

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www

# Set working directory
WORKDIR /var/www
COPY . /var/www/

USER root

