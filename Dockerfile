FROM php:7.3-fpm
COPY php.ini /usr/local/etc/php/
COPY  . /var/www/

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client \
  && apt-get install -y libzip-dev \
  && docker-php-ext-install zip pdo_mysql
WORKDIR /var/www

##Composer install
#COPY --from=composer /usr/bin/composer /usr/bin/composer
#
#ENV COMPOSER_ALLOW_SUPERUSER 1
#
#ENV COMPOSER_HOME /composer
#
#ENV PATH $PATH:/composer/vendor/bin
#
#
#
#RUN composer global require "laravel/installer"
