#!/bin/bash

echo 'Base de Datos. Usuario: '
read BD_USER
echo 'Base de Datos. Password: '
read BD_PASSWORD

# Archivos de configuracion
if [ ! -f app/config/parameters.yml ]
then
    cp app/config/parameters.yml-dist app/config/parameters.yml
fi

# Composer
if [ ! -f composer.phar ]
then
    wget http://getcomposer.org/composer.phar
fi

php composer.phar install

chmod -R ugo+rwx app/cache
chmod -R ugo+rwx app/logs
mysqladmin --force drop --user=$BD_USER --password=$BD_PASSWORD cupon 
mysqladmin --force create --user=$BD_USER --password=$BD_PASSWORD cupon 
mysql --user=$BD_USER --password=$BD_PASSWORD cupon < database-dump.sql