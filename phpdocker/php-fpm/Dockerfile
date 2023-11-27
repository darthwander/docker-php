FROM phpdockerio/php:8.1-fpm
WORKDIR "/app"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \ 
        php8.1-amqp \ 
        php8.1-imap \ 
        php8.1-memcached \ 
        php8.1-oauth \ 
        php8.1-pgsql \ 
        php8.1-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

    # Instalar o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN cd public && composer create-project slim/slim-skeleton suzapp
