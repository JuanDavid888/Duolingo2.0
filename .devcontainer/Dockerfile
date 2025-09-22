FROM mcr.microsoft.com/devcontainers/php:1-8.3-bullseye

USER root

# SO deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip zip curl libpq-dev libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libssl-dev ca-certificates \
 && update-ca-certificates \
 && rm -rf /var/lib/apt/lists/*

# PHP ext
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" bcmath intl pdo pdo_mysql pdo_pgsql zip gd exif pcntl sockets

# Node 20 + pnpm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get update && apt-get install -y nodejs \
 && npm i -g pnpm@9

# Config PHP
COPY .devcontainer/php.ini /usr/local/etc/php/conf.d/zz-dev.ini
COPY .devcontainer/xdebug.ini /usr/local/etc/php/conf.d/zz-xdebug.ini

# Unifica ruta de trabajo con devcontainer.json
WORKDIR /workspaces/app

# Permisos
RUN chown -R vscode:vscode /workspaces

USER vscode
