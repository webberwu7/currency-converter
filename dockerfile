FROM public.ecr.aws/dwchiang/nginx-php-fpm:7.3.32-fpm-buster-nginx-1.20.1

RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl zip unzip 

RUN docker-php-ext-install -j$(nproc) \
        bcmath \
        mysqli \
        pdo \
        pdo_mysql \
        exif \
        opcache

RUN apt-get -y install curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD /src /var/www/html
WORKDIR /var/www/html

RUN composer install --prefer-dist
RUN composer dump-autoload

RUN chown -R www-data:www-data /var/www/html
RUN chmod 770 /var/www/html/storage
EXPOSE 80
CMD ["/docker-entrypoint.sh"]
