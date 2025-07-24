# ======================
# Tahap 1: Builder
# ======================
FROM php:8.2-fpm AS builder

WORKDIR /app

# Install dependencies
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

RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN npm install && npm run build

# ======================
# Tahap 2: Runtime
# ======================
FROM php:8.2-fpm AS runtime

WORKDIR /app

COPY --from=builder /app /app

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 10000

# 🔧 Tambahkan: Clear cache SAAT CONTAINER RUNNING
CMD ["sh", "-c", "php artisan config:clear && php artisan cache:clear && php artisan serve --host=0.0.0.0 --port=10000"]
