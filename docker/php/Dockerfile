FROM php:7.2.26-fpm

ENV BUILD_DEPS \
    build-essential \
    zlib1g-dev \
    libicu-dev \
    libpcre3-dev \
    libpq-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libmemcached-dev \
    libxml2-dev

ENV RUNTIME_DEPS \
    libicu63 \
    libpq5 \
    unzip \
    libfcgi0ldbl \
    libpng16-16 \
    libjpeg62-turbo \
    libmemcached11 \
    libmemcachedutil2 \
    libxml2

ENV PHP_EXTENSIONS \
    gd \
    opcache \
    zip \
    intl \
    mbstring \
    pdo_mysql \
    bcmath \
    soap \
    sockets

ENV PECL_EXTENSIONS_INSTALL \
    xdebug-2.7.2 \
    redis-4.3.0 \
    memcached

ENV PECL_EXTENSIONS \
    xdebug \
    redis \
    memcached

RUN apt-get update && apt-get install -y --no-install-recommends ${BUILD_DEPS} \
    && docker-php-ext-install ${PHP_EXTENSIONS} \
    && pecl install ${PECL_EXTENSIONS_INSTALL} \
    && docker-php-ext-enable ${PECL_EXTENSIONS} \
    && apt-get autoremove -y ${BUILD_DEPS} \
    && apt-get install -y ${RUNTIME_DEPS} \
    # Disable Xdebug by default
    && rm -rf /var/lib/apt/lists/* \
    && sed -i 's/^/;/' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /root/.composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/overrides.conf /usr/local/etc/php-fpm.d/z-overrides.conf
COPY docker/php/php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY docker/php/php-entrypoint.sh /usr/local/bin
COPY docker/php/php-fpm-check /usr/local/bin

WORKDIR /application

ENTRYPOINT ["php-entrypoint.sh"]
CMD ["php-fpm"]
