# ======================
# Tahap 1: Builder
# ======================
FROM php:8.2-fpm AS builder

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copy Laravel project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install frontend dependencies & build assets
RUN npm install && npm run build

# Hapus cache biar APP_DEBUG aktif
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear

# ======================
# Tahap 2: Runtime (Final untuk Render)
# ======================
FROM php:8.2-fpm AS runtime

WORKDIR /app

# Copy seluruh hasil builder
COPY --from=builder /app /app

# Pastikan permission Laravel bisa ditulis
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Expose port yang dipakai Laravel (via php artisan serve)
EXPOSE 10000

# Jalankan Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
