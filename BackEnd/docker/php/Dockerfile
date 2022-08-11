FROM php:8.1.1-fpm-alpine3.15

RUN apk add --update \
		$PHPIZE_DEPS \
		freetype-dev \
		git \
		libjpeg-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-jpeg --with-freetype \
	&& docker-php-ext-install gd