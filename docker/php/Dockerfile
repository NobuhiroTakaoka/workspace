FROM php:8.0-fpm

# install composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer \n\
| php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim

RUN apt-get update \
    && apt-get install -y libpq-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mysqli simplexml

# Xdebugのインストール
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html
