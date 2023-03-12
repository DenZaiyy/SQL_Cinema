FROM php:8.1.10-apache
COPY . /var/www/html/
WORKDIR /var/www/html/
RUN docker-php-ext-install \
    pdo pdo_mysql