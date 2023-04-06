FROM php:8.1-fpm

ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure PHP extensions
RUN docker-php-ext-configure intl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Get latest composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer clearcache && composer selfupdate

# Create system user to run composer and artisan commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
