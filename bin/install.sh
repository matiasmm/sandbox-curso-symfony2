#!/bin/bash

if [ ! -f app/config/parameters.yml ]
then
    cp app/config/parameters.yml-dist app/config/parameters.yml
fi

chmod -R ugo+rwx app/cache
chmod -R ugo+rwx app/logs
mysqladmin --force drop cupon -u root
mysqladmin --force create cupon -u root
mysql -u root cupon < database-dump.sql
