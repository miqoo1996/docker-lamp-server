FROM php:7.4-apache


RUN apt-get update && apt-get install -y && a2enmod rewrite


RUN docker-php-ext-install mysqli pdo pdo_mysql


RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
        git \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY apache/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY apache/php.ini /etc/php/7.4/apache2/php.ini
