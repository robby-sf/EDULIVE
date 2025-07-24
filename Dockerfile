# ======================
# Tahap 1: Builder
# ======================
FROM php:8.2-fpm AS builder

# Set working directory
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

# Laravel optimization
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# ======================
# Tahap 2: Runtime (Final image untuk Render)
# ======================
FROM php:8.2-cli AS runtime

WORKDIR /app

# Copy project dari builder
COPY --from=builder /app /app

# Expose HTTP port (Render butuh ini)
EXPOSE 10000

# Jalankan Laravel dengan built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
