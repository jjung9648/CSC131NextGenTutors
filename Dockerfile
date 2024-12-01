
FROM php:8.1-apache


RUN a2enmod rewrite
COPY www /var/www/html


RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo_mysql

CMD ["apache2-foreground"]
