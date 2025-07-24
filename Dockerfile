# Gunakan image PHP + Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Salin semua file project ke dalam container
COPY . .

# Salin konfigurasi Apache agar bisa akses public/
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Install depedensi Laravel
RUN composer install --optimize-autoloader --no-dev

# Generate key (opsional, bisa juga dari ENV)
# RUN php artisan key:generate

# Set permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80
