# Tahap 1: Builder - Menginstal semua dependensi
FROM php:8.2-fpm as builder

# Set direktori kerja
WORKDIR /app

# Install dependensi sistem yang dibutuhkan
# libpng-dev, libjpeg-dev, etc., untuk proses gambar
# libzip-dev untuk ekstensi zip
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

# Install ekstensi PHP yang umum digunakan Laravel
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js dan npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Salin semua file proyek
COPY . .

# Install dependensi composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install dependensi npm dan build aset frontend
RUN npm install && npm run build

# Optimasi untuk produksi
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache


# Tahap 2: Production - Image final yang ramping
FROM php:8.2-fpm as production

WORKDIR /app

# Salin hanya file yang dibutuhkan dari tahap builder
COPY --from=builder /app/bootstrap /app/bootstrap
COPY --from=builder /app/config /app/config
COPY --from=builder /app/database /app/database
COPY --from=builder /app/public /app/public
COPY --from=builder /app/resources /app/resources
COPY --from=builder /app/routes /app/routes
COPY --from=builder /app/storage /app/storage
COPY --from=builder /app/vendor /app/vendor
COPY --from=builder /app/artisan /app/artisan
COPY --from=builder /app/composer.json /app/composer.json

# Atur kepemilikan file agar bisa ditulis oleh web server
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Expose port yang digunakan oleh PHP-FPM
EXPOSE 9000

# Perintah default untuk menjalankan container
CMD ["php-fpm"]
