FROM php:7.3-fpm
ENV TZ Asia/Tokyo
ENV COMPOSER_ALLOW_SUPERUSER 1

#chownでCOPYの設定 左がユーザー名:グループ名となる
# install Lib for composer
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get update -qq && \
    apt-get install --no-install-recommends -y libpq-dev libonig-dev libxml2-dev nodejs git zip unzip && \
    apt-get install --no-install-recommends -y zlib1g-dev libfreetype6-dev libpng-dev libjpeg62-turbo-dev libwebp-dev libxpm-dev && \
    apt-get clean && \
    rm -rf /var/cache/apt && \
    npm install npm@latest -g

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client \
  && apt-get install -y libzip-dev \
  && docker-php-ext-install zip pdo_mysql

# php.conf php-fpm.conf
COPY conf/php.ini /usr/local/etc/php/php.ini
COPY conf/docker.conf /usr/local/etc/php-fpm.d/docker.conf

# install Lib for composer
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get update -qq && \
    apt-get install --no-install-recommends -y libpq-dev libonig-dev libxml2-dev nodejs git zip unzip && \
    apt-get install --no-install-recommends -y zlib1g-dev libfreetype6-dev libpng-dev libjpeg62-turbo-dev libwebp-dev libxpm-dev && \
    apt-get clean && \
    rm -rf /var/cache/apt && \
    npm install npm@latest -g

# install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /app

