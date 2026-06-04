FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    postgresql-dev \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    intl \
    zip \
    xml \
    bcmath \
    tokenizer \
    fileinfo

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project files
COPY . .

# Install PHP dependencies (no dev in production)
RUN composer install --optimize-autoloader --no-dev --no-interaction --no-progress

# Cache and optimize Laravel
RUN php artisan optimize:clear

# Create and set permissions for storage and bootstrap/cache
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache \
    && chown -R www-data:www-data storage \
    && chown -R www-data:www-data bootstrap/cache

# Copy Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Copy Supervisor config
COPY supervisor.conf /etc/supervisor/supervisord.conf

# Expose port 10000
EXPOSE 10000

# Start Supervisor to manage both php-fpm and nginx
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
