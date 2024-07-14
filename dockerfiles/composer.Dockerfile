FROM composer:latest

WORKDIR /var/www/laravel

RUN composer require symfony/http-client symfony/dom-crawler

ENTRYPOINT ["composer", "--ignore-platform-reqs"]