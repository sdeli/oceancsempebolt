#  

# local setup
- The setup is built upon the official [wordpress image](https://hub.docker.com/_/wordpres) and its adviced docker-compose.yml file,
which is extended by the official [phpmyadmin image](https://hub.docker.com/r/phpmyadmin/phpmyadmin/). 

## The doc describes
 1. How you can create a local clone of a production/staging wp install of ocean
 3. Commands to manage wp instance

## You will need:
- You will need docker and docker compose installed or docker desktop.
- For creating a local clone of a wp install you will need the following values and they need to match the 'docker-compose.yml' file
  - [MYSQL_DATABASE]
  - [MYSQL_USER]
  - [MYSQL_PASSWORD]
- composer for running scripts and docker managing commands

## Good to know
- Wordpress files are stored in the ./wp folder
- We are **versioning** in git (from the parts of the app) just **./wp/wp-content/themes/flatsome-child** folder, the rest should be stored in backups, created by reliable plugin/updraftplus/host provider
- Mysql database is stored in the ./mysql folder but not getting versioned
- This project uses composer so if you dont have composer installed globally run:
```sh
curl -sS https://getcomposer.org/installer | php
php composer.phar install
mv composer.phar /usr/local/bin/composer
```
- this project uses https://wpackagist.org/ to manage packages

## Create a local clone of a oceancsempebolt.hu wp install

### 1. Basic Preparations**
- Make sure there is no such installation already
  - delete wp folders content apart of project files.
  - if you have mysql folder delete it
  - check if there is no same containers already running
- Create a ./docker-compose.yml from ./docker-compose.example
- Add the values for the env variables in ./docker-compose.yml, where you see `user should fill out`.

### 3. Prepare project files
- Copy the oceancsempebolt.hu wp installs wp-content/plugins, wp-content/themes, wp-content/uploads folders files into the ./wp/wp-content folder.
- **Disbale all caching plugins on the oceancsempebolt.hu before exporting the db.**
- Export the db via phpmyadmin or however you can, as a result you should have a [file-name].sql file.
- Move the [file-name].sql file to the ./assets folder
- you may need to add this line to you [file-name].sql file:
```sh
USE `[MYSQL_DATABASE]`;
```

### 4. Spin up the clone
```sh
composer up
```
- Add these lines to wp-config just out of security
```php
define('WP_HOME','http://localhost');
define('WP_SITEURL','http://localhost');
define( 'WP_DEBUG', true );
```
- import the ./assets/[file-name].sql file:
```sh
# run:
composer importdb -- password [MYSQL_ROOT_PASSWORD] ./assets/[file-name].sql
```
it will exchange urls to localhost and install wp-cli on the wordpress container

### 5. Clone is running**
- At this point the living clone should be reachable at http://localhost and phpmyadmin at http://localhost:8080
- **you may need to import flatsome theme settings** go to admin dashboard/flatsome/backup and import, then backup the settings and import it into the clone
- And you may need to add these lines to wp-config, if website loading is really slow and you see wp-cron in the wordpress logs:
```php
define('DISABLE_WP_CRON', true);
```
- At the beginning a plugin called 'smart slider' will create a lot of chache for images which are getting loaded into a slider and thatswhy first calls on urls will be slow but after it will be fast.
- In a plugin called "Berocket" you need to save any of the filters, without any change, that it starts to work properly.

### 6. Disable plugins not needed on local
```sh
# attach to the wordpress container
composer attach:wp

# disable plugins not needed for development
# example:
wp plugin deactivate algori-pdf-viewer gtm-ecommerce-woo-pro algori-pdf-viewer autoptimize wordfence wp-rocket wps-woocommerce-simplepay-payment-gateway --allow-root
```

### 6. Install Dev Plugins
You may install some **debug / dev plugins** like:
- [Query Monitor](https://wordpress.org/plugins/search/query+monitor/)
- [show hooks](https://wordpress.org/plugins/search/show+hooks/)

## 7. Xdebug setup
- In this repo we are using __xdebug-3.1.4__
- It's settings which make it work lie in __scripts/xdebug-3.1.4/xdebug.ini__
- With ```composer debug:activate``` you can activate it, and from that point on it listens to any debugging client. (You need to run the command just once.)
- For Vscode usage you need to have these settings in your launch.json
```js
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Docker Listen for XDebug",
      "type": "php",
      "request": "launch",
      "hostname": "localhost",
      "port": 9003,
      "log": true,
      "pathMappings": {
        "/var/www/html": "${workspaceRoot}/wp",
      }
    },
  ]
}
```

## Important Commands
```sh
# list all containers
composer ls

# start running containers
composer up

# stop running containers
composer down

# restart all containers
composer restart

# purge all running containers
composer purge

# attach/log into a container
docker exec -it [container-id] /bin/bash

# activate debugger
# you need to run this command just once in the lifetime of the wp container
composer debug:activate
```