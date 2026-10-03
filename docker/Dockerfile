FROM php:8.5-fpm-bookworm
RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev libicu-dev libonig-dev libxml2-dev libzip-dev unzip git \
    && docker-php-ext-install -j2 pdo_pgsql intl mbstring zip \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.json composer.lock symfony.lock ./
RUN composer install --no-scripts --no-interaction --prefer-dist
COPY . .
RUN composer dump-autoload --optimize --no-scripts && mkdir -p var && chown -R www-data:www-data var
ENTRYPOINT ["/app/docker/entrypoint.sh"]
CMD ["php-fpm"]
