FROM php:8.1-apache

RUN apt-get update && \
    apt-get -y install apt-utils gnupg2 && \
    apt-get -y upgrade && \
    apt-get update --fix-missing && \
    apt-get --purge autoremove -y

RUN apt-get install -y \
    openssl \
    zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    supervisor \
    wget \
    libxml2-dev \
    git

RUN a2enmod rewrite proxy proxy_http proxy_wstunnel headers

# install redis
#RUN pecl install redis && \
#    docker-php-ext-enable redis

# install php extensions
RUN docker-php-ext-install \
    pdo pdo_mysql \
    mbstring  \
    xml simplexml \
    soap \
    zip \
    pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-enable gd

# xdebug
#RUN apt-get install $PHPIZE_DEPS \
#    && pecl install xdebug-3.1.4
#    && docker-php-ext-enable xdebug

# copy files
WORKDIR /var/www
COPY ./ /var/www

# install composer packages
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# install npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs && \
    npm install && \
    npm run prod

# apache, php setup
COPY ./.docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN echo 'memory_limit = 256M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# cleanup
RUN rmdir /var/www/html && \
    chown -R www-data: /var/www && \
    rm -rf /var/lib/apt/lists/*
