#!/bin/bash

echo 'Base de Datos. Usuario: '
read BD_USER
echo 'Base de Datos. Password: '
read BD_PASSWORD


if [ ! -f app/config/parameters.yml ]
then
    cp app/config/parameters.yml-dist app/config/parameters.yml
fi

wget http://getcomposer.org/composer.phar
php composer.phar install

chmod -R ugo+rwx app/cache
chmod -R ugo+rwx app/logs
mysqladmin --force drop --user=$BD_USER --password=$BD_PASSWORD cupon 
mysqladmin --force create --user=$BD_USER --password=$BD_PASSWORD cupon 
mysql --user=$BD_USER --password=$BD_PASSWORD cupon < database-dump.sql