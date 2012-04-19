#!/bin/bash
echo 'Base de Datos. Usuario: '
read BD_USER
BD_USER="${BD_USER// /\\ }"
echo $BD_USER
echo 'Base de Datos. Password: '
read BD_PASSWORD

BD_PASSWORD="${BD_PASSWORD// /\\ }"

chmod -R ugo+rwx app/cache/*
chmod -R ugo+rwx app/logs/*

# Composer
rm composer.phar
if [ ! -f composer.phar ]
then
    wget http://getcomposer.org/composer.phar
fi

php composer.phar update



mysqladmin --force drop --user=$BD_USER --password=$BD_PASSWORD cupon 
mysqladmin --force create --user=$BD_USER --password=$BD_PASSWORD cupon 
mysql --user=$BD_USER --password=$BD_PASSWORD cupon < database-dump.sql


