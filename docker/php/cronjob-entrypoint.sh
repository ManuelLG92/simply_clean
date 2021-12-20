#!/bin/bash

echo -e "Logged user"
id

echo -e "Permissions in folders"
sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX var/cache var/log public/temp
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx var/cache var/log public/temp

bin/console cache:clear

echo -e "Start crontab"
crontab /home/develop/langen-crontab

# Start crontab
sudo /usr/sbin/cron && tail -f /var/log/cron.log