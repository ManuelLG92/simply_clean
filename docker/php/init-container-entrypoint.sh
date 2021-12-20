#!/bin/bash

echo -e "Copy public files into share folder"
cp -r /var/www/html/laliga-back/public_bak/* /var/www/html/laliga-back/public/

echo -e "Schema update in background"
bin/console doctrine:schema:update --force &

echo -e "Installing assets in background"
bin/console assets:install

echo -e "Logged user" 
id                    

echo -e "Permissions in folders"
sudo setfacl -R -m u:www-data:rwX -m u:develop:rwX var/cache var/log
sudo setfacl -dR -m u:www-data:rwx -m u:develop:rwx var/cache var/log

echo -e "Clear Symfony cache in background"
bin/console cache:clear



