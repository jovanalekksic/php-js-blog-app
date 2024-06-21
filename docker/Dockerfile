FROM php:5.6-fpm

# Use archived repositories for Debian Stretch
RUN echo "deb http://archive.debian.org/debian stretch main contrib non-free" > /etc/apt/sources.list \
    && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until

# Install required packages
RUN apt-get update --allow-insecure-repositories \
    && apt-get install -y \
        libmcrypt-dev \
        libpng-dev \
        mysql-client \
        libxml2-dev \
        zlib1g-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PECL extensions raphf and propro
RUN pecl install https://pecl.php.net/get/raphf-1.1.2.tgz https://pecl.php.net/get/propro-1.0.2.tgz \
    && docker-php-ext-enable raphf propro

# Install PECL extension pecl_http
RUN pecl install https://pecl.php.net/get/pecl_http-2.6.0.tgz \
    && docker-php-ext-enable http

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) mcrypt gd pdo_mysql mysqli mysql
