FROM php:8.1 as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www
COPY . .
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000

ENTRYPOINT sh "./Docker/entrypoint.sh"


FROM node:18-alpine as node
WORKDIR /var/www
COPY . .
RUN npm install --global cross-env
RUN npm install --force
RUN npm run build

VOLUME /var/www/node_modules


