FROM php:7-alpine

RUN set -ex
RUN apk --no-cache add postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql