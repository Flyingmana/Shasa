FROM php:7.4-apache


HEALTHCHECK CMD nc -z localhost 80

COPY --chown=www-data . /var/www/html/
