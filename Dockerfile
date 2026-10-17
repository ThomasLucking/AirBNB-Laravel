FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-scripts

FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY --from=vendor /app ./
RUN npm run build

FROM php:8.4-cli
WORKDIR /app
COPY --from=vendor /app ./
COPY --from=assets /app/public/build ./public/build
RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs storage/app/public bootstrap/cache data \
    && php artisan storage:link \
    && chown -R www-data:www-data storage bootstrap/cache data
USER www-data
EXPOSE 8000
HEALTHCHECK --interval=30s --timeout=5s --start-period=30s CMD php -r "exit(@file_get_contents('http://127.0.0.1:8000/up') === false ? 1 : 0);"
# ponytail: artisan serve is single-process; swap for FrankenPHP/nginx+fpm if traffic grows
CMD ["sh", "-c", "export DB_DATABASE=\"${DB_DATABASE:-/app/data/database.sqlite}\" && touch \"$DB_DATABASE\" && php artisan migrate --force && php artisan optimize && exec php artisan serve --host=0.0.0.0 --port=8000"]
