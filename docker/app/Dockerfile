#PHP
FROM php:8.1-fpm
RUN apt-get update --fix-missing \
    && apt-get install -y curl wget zip unzip git \
    && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd 
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
#PDO
# Install Postgres PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
#Zip
#Install Zip
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip
# DEPENDENCIES
RUN apt-get update --fix-missing \
    && apt-get install -y  python \
    && rm -rf /var/lib/apt/lists/*
#Node JS
RUN curl -sL https://deb.nodesource.com/setup_18.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install nodejs -y
RUN command -v node
RUN command -v npm
#Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    composer self-update --preview
RUN command -v composer


