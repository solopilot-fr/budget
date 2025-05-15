FROM php:8.4-cli-alpine

ARG USERNAME=dev
ARG USER_UID=1000
ARG USER_GID=$USER_UID
ARG USER_SHELL=/bin/bash

USER root

RUN apk add --no-cache \
    git \
    shadow \
    linux-headers \
    $PHPIZE_DEPS && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    if id -u ${USERNAME} > /dev/null 2>&1; then \
        # Modifier le shell si l'utilisateur existe
        usermod --shell ${USER_SHELL} ${USERNAME}; \
    else \
        # Créer le groupe si nécessaire
        groupadd -g ${USER_GID} -f ${USERNAME}; \
        # Créer l'utilisateur avec le shell spécifié
        useradd --uid ${USER_UID} --gid ${USER_GID} -m ${USERNAME} --shell ${USER_SHELL}; \
    fi;

RUN apk del $PHPIZE_DEPS linux-headers

RUN apk update && apk add --no-cache sudo bash git && rm -rf /var/cache/apk/* && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"  && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    chmod +x /usr/local/bin/composer
