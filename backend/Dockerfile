# အပေါ်ဆုံးစာကြောင်းကို 8.2 မှ 8.3 သို့ ပြောင်းလိုက်ပါ
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    git \
    postgresql-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    mbstring \
    intl \
    zip \
    xml \
    bcmath \
    gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# --ignore-platform-reqs ကိုပါ တစ်ခါတည်း တွဲထည့်ထားပေးခြင်းဖြင့် ပိုမိုစိတ်ချရစေပါတယ်
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Setup Nginx and Supervisor Configuration
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 10000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]
