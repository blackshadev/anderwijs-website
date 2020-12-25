FROM composer:2 as vendor
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist

FROM craftcms/php-fpm:7.4 as base

FROM base as prod
# the user is `www-data`, so we copy the files using the user and group
COPY --chown=www-data:www-data --from=vendor /app/vendor/ /app/vendor/
COPY --chown=www-data:www-data . .

FROM base as dev

ARG USERID
ARG GROUPID
ARG OSTYPE
USER root
RUN apk -U --no-cache add \
    shadow \
    && sh -c 'if [ "${OSTYPE}" != "Darwin" ]; then usermod -u ${USERID} www-data; fi' \
    && sh -c 'if [ "${OSTYPE}" != "Darwin" ]; then groupmod -g ${GROUPID} www-data; fi'

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

USER www-data
