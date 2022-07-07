#!/bin/bash
source ./.credentials
if [ -z $DEV_FTP_PASSWORD ] || [ -z $DEV_FTP_USER ] || [ -z $DEV_FTP_HOST ] || [ -z $DEV_FTP_PORT ]; then
        echo "one of the variables: \"DEV_FTP_USER DEV_FTP_PASSWORD DEV_FTP_HOST DEV_FTP_PORT\" is not set in .credentials"
        exit 1;
fi

ENV=$1

if [[ $ENV == 'production' ]]; then
  read -p "did you update design categories? (y|n): " has_checked_categories_file  
  if [ $has_checked_categories_file = 'n' ]; then exit 0; fi;

  FTP_USER=$DEV_FTP_USER
  FTP_PASSWORD=$DEV_FTP_PASSWORD
  FTP_HOST=$DEV_FTP_HOST
  FTP_PORT=$DEV_FTP_PORT
  echo 'deploying to prod env'
else
  read -p "did you update design categories? (y|n): " has_checked_categories_file  
  if [ $has_checked_categories_file = 'n' ]; then exit 0; fi;

  FTP_USER=$DEV_FTP_USER
  FTP_PASSWORD=$DEV_FTP_PASSWORD
  FTP_HOST=$DEV_FTP_HOST
  FTP_PORT=$DEV_FTP_PORT
fi

mv ./html ./web

jq '.autoload."psr-4"."Shared\\" = "web/wp-content/Shared" | .autoload."psr-4"."Inc\\" = "web/wp-content/plugins/oceancsempebolt/Inc" | .autoload.classmap = ["web/wp-content/plugins/oceancsempebolt/classes"] | .config."vendor-dir" = "web/wp-content/vendor"' ./composer.json > composer-temp.json
COMPOSER=composer-temp.json composer install
rm composer-temp.json
rm composer-temp.lock

mv ./web ./html

echo $FTP_USER;
lftp -u $FTP_USER,$FTP_PASSWORD -p $FTP_PORT $FTP_HOST <<EOL
rm -r /web/wp-content/vendor
rm -r /web/wp-content/Shared
rm -r /web/wp-content/themes/flatsome-child
rm -r /web/wp-content/plugins/oceancsempebolt
mirror -R ./html/wp-content/vendor /web/wp-content/vendor
mirror -R ./html/wp-content/Shared /web/wp-content/Shared
mirror -R ./html/wp-content/themes/flatsome-child /web/wp-content/themes/flatsome-child
mirror -R ./html/wp-content/plugins/oceancsempebolt /web/wp-content/plugins/oceancsempebolt
EOL

rm -rf ./html/wp-content/vendor
composer install
