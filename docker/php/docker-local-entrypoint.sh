#!/bin/bash

sudo rm -rf var/cache/*

composer install --ansi --no-interaction
sudo setfacl -R -m u:101:rwX -m u:`whoami`:rwX var/cache var/log  public/tmp
sudo setfacl -dR -m u:101:rwx -m u:`whoami`:rwx var/cache var/log public/tmp
er
exec sudo /usr/sbin/php-fpm8.1 -O
