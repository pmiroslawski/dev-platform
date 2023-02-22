FROM php:8.1.14-fpm-bullseye

LABEL author="Pawel Miroslawski <pmiroslawski@gmail.com>"
LABEL version="1.0"

ADD development/php.ini /root/php.ini
RUN mv "/root/php.ini" "$PHP_INI_DIR/php.ini"

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get update && apt-get install -y \
    vim \
    openssl \
    git \
    git-flow \
    libssh2-1-dev \
    unzip \
    pkg-config zlib1g zlib1g-dev libmemcached-dev \
    libicu-dev \
    software-properties-common \
    libzip-dev \
    libpng-dev \
    apt-transport-https \
    gnupg \
    librabbitmq-dev \
    nodejs \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd  --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd bcmath intl pdo pdo_mysql mysqli opcache sockets

# update pecl packages
RUN pecl channel-update pecl.php.net
RUN pecl install amqp && docker-php-ext-enable amqp
RUN pecl install apcu && docker-php-ext-enable apcu
RUN pecl install redis && docker-php-ext-enable redis.so
RUN pecl install zip && docker-php-ext-enable zip

WORKDIR /var/www/rma/app-app
