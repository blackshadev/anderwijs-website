FROM alpine:3.12 as base

ADD https://dl.bintray.com/php-alpine/key/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub
RUN apk --update add ca-certificates
RUN echo "https://dl.bintray.com/php-alpine/v3.12/php-7.4" >> /etc/apk/repositories

RUN apk -U upgrade && apk add --no-cache \
    argon2 \
    curl \
    gzip \
    shadow \
    icu \
    php-fpm \
    php7 \
    php7-bcmath \
    php7-ctype \
    php7-curl  \
    php7-dom  \
    php7-gd \
    php7-iconv \
    php7-intl \
    php7-json \
    php7-mbstring \
    php7-openssl \
    php7-pdo \
    php7-pdo_pgsql \
    php7-phar \
    php7-session \
    php7-xmlreader \
    php7-zip \
    php7-zlib \
    nginx \
    tzdata \
    && ln -s /usr/sbin/php-fpm7 /usr/sbin/php-fpm \
    && addgroup -S php \
    && adduser -S -G php php \
    && rm -rf /var/cache/apk/* && rm -rf /etc/php7/php-fpm.d

COPY --from=postgres:13-alpine /usr/local/bin/pg_dump /usr/local/bin/pg_dump

RUN ln /usr/bin/php7 /usr/bin/php

COPY docker/files/general docker/files/php7 /
COPY docker/s6-overlay-amd64.tar.gz /tmp

RUN gunzip -c /tmp/s6-overlay-amd64.tar.gz | tar -xf - -C /

# Enable options supported by this version of PHP-FPM
RUN sed '/decorate_workers_output/s/^; //g' /etc/php7/php-fpm.conf

WORKDIR /www

ENTRYPOINT ["/init"]

EXPOSE 80

HEALTHCHECK --interval=5s --timeout=5s CMD curl -f http://127.0.0.1/php-fpm-ping || exit 1

FROM base as prod

COPY --chown=php:php . .

FROM base as dev

ARG USERID
ARG GROUPID
ARG OSTYPE

RUN apk -U --no-cache add \
    shadow \
    && sh -c 'if [ "${OSTYPE}" != "Darwin" ]; then usermod -u ${USERID} php; fi' \
    && sh -c 'if [ "${OSTYPE}" != "Darwin" ]; then groupmod -g ${GROUPID} php; fi'

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
