FROM phpdockerio/php:8.1-fpm
WORKDIR /var/www/html

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

COPY files/php.ini /etc/php/8.1/cli/conf.d/99-overrides.ini

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php8.1-mysql php8.1-sqlite php-http php8.1-redis nano curl wget unzip libmcrypt-dev git php8.1-gd php-intl php-raphf php-propro cron sudo php8.1-xdebug php8.1-amqp \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# CONFIG PHP
COPY files/php-fpm-pool.conf /usr/local/etc/php/pool.d/www.conf
COPY files/php.ini /usr/local/etc/php/php.ini

ARG USER_ID
ARG GROUP_ID

RUN groupadd develop --gid ${GROUP_ID}
RUN useradd -rm -d /home/develop -s /bin/bash -g develop -G root -o -u ${USER_ID} develop
RUN echo "develop:develop" | chpasswd && adduser develop sudo
RUN usermod -G www-data develop && usermod -G sudo develop
RUN chown -R develop:develop /var/www/html
COPY files/sudoers.txt /etc/sudoers
COPY --chown=${USER_ID}:${GROUP_ID} . /var/www/html/laliga-back

USER develop

WORKDIR /var/www/html/laliga-back/
RUN mkdir -p /home/develop/.composer \
&& chown -R develop /home/develop/.composer
COPY --chown=develop:develop docker-local-entrypoint.sh /home/develop/docker-entrypoint.sh
RUN sudo chmod +x /home/develop/docker-entrypoint.sh

EXPOSE 9000
CMD ["/home/develop/docker-entrypoint.sh"]