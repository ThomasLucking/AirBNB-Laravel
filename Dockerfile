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
RUN php artisan storage:link
EXPOSE 8000
# ponytail: artisan serve is single-process; swap for FrankenPHP/nginx+fpm if traffic grows
CMD ["sh", "-c", "touch \"$DB_DATABASE\" && php artisan migrate --force && php artisan optimize && php artisan serve --host=0.0.0.0 --port=8000"]
