FROM php:7.1.8-apache
COPY --from=composer:1 /usr/bin/composer /usr/local/bin/composer
COPY . /workspace
WORKDIR /workspace
RUN apt-get update &&\
    apt-get install -y \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    zip \
   libxml2-dev \
   libyaml-dev \
    unzip &&\
    pecl \
    a2enmod rewrite

RUN mkdir vendor
RUN chown -R www-data:www-data /workspace

RUN pecl install yaml && docker-php-ext-enable yaml
RUN docker-php-ext-install mcrypt xml soap sockets mbstring
USER www-data
RUN composer install
RUN php ./vendor/bin/phpunit "$@"