FROM php:7.3-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/

COPY  --chown=www-data:www-data  ./ /var/www/
#chownでCOPYの設定 左がユーザー名:グループ名となる

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client \
  && apt-get install -y libzip-dev \
  && docker-php-ext-install zip pdo_mysql
WORKDIR /var/www

