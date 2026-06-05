FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    && docker-php-ext-install sockets

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080

CMD ["php", "server.php"]
