#!/bin/bash

#docker-php-ext-install sockets

chown -R www-data:www-data /app

echo "++++++++++++++++++++++++++++++++++++++++++";

if [ ! -z "$D_BASE_PATH_ASSETS" ]
then
  echo "D_BASE_PATH_ASSETS : $D_BASE_PATH_ASSETS"
  mkdir -p $D_BASE_PATH_ASSETS
  chown -R www-data:www-data $D_BASE_PATH_ASSETS
  chmod -R 777 $D_BASE_PATH_ASSETS
else
  echo "D_BASE_PATH_ASSETS is not set"
fi

if [ ! -z "$D_BASE_PATH_RUNTIME" ]
then
  echo "D_BASE_PATH_RUNTIME : $D_BASE_PATH_RUNTIME"
  mkdir -p $D_BASE_PATH_RUNTIME
  chown -R www-data:www-data $D_BASE_PATH_RUNTIME
  chmod -R 777 $D_BASE_PATH_RUNTIME
else
  echo "D_BASE_PATH_RUNTIME is not set"
fi

echo "++++++++++++++++++++++++++++++++++++++++++";

composer self-update --2
composer global remove hirak/prestissimo

if [ $YII_ENV == "dev" ]; then
  ln -sfT /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
  composer install -v
else
  ln -sfT /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
  composer install -v --no-dev --no-progress
fi

echo "++++++++++++++++++++++++++++++++++++++++++";

chmod +x clean.sh init restart.sh yii

init --env=$YII_ENVIRONMENT_NAME --overwrite=All

echo "++++++++++++++++++++++++++++++++++++++++++";

#yii migrate --interactive=0
#yii migrate --migrationPath=@yii/rbac/migrations/ --interactive=0

yii cache/flush-all

bash -v clean.sh

php-fpm
