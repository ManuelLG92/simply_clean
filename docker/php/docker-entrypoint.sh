#!/bin/bash

echo -e "Logged user"
id

echo -e "Permissions in folders"
sudo setfacl -R -m u:www-data:rwX -m u:develop:rwX var/cache var/log
sudo setfacl -dR -m u:www-data:rwx -m u:develop:rwx var/cache var/log

bin/console cache:clear &

echo -e "Start PHP"
exec sudo php-fpm -F