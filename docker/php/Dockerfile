ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

WORKDIR /var/www/html

LABEL maintainer="sonmh"
LABEL desc="init source"

RUN apt update && apt install -y \
    vim \
    zip \
    unzip\
    libmagickwand-dev\
    imagemagick\
    openssl \
    libssl-dev \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get -y install nodejs

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

CMD ["/var/www/html/docker/php/script.sh"]
