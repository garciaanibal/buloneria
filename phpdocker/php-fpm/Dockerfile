FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

# Instalar dependencias del sistema, Node.js y Yarn
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        curl \
        gnupg \
        php8.2-mysql \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && apt-get update && apt-get install -y yarn \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
