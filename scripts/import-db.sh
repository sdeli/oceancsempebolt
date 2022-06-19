#!/bin/bash
MYSQL_ROOT_PASSWORD=$1
MYSQL_DATABASE=$2
SQL_FILE=$3

echo 'This may take some time!'
echo "Importing db"
docker exec -i mysql mysql -uroot -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < $SQL_FILE

echo "installing wp cli for search and replace"
docker exec -i wp curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
docker exec -i wp chmod +x /var/www/html/wp-cli.phar
docker exec -i wp mv /var/www/html/wp-cli.phar /usr/local/bin/wp

echo "exchanging https://oceancsempebolt.hu to http://localhost in db"
docker exec -i wp wp search-replace https://oceancsempebolt.hu http://localhost --allow-root
echo "exchanging http://oceancsempebolt.hu to http://localhost in db"
docker exec -i wp wp search-replace http://oceancsempebolt.hu http://localhost --allow-root
echo "exchanging http://www.oceancsempebolt.hu to http://localhost in db"
docker exec -i wp wp search-replace http://www.oceancsempebolt.hu http://localhost --allow-root
echo "exchanging https://www.oceancsempebolt.hu to http://localhost in db"
docker exec -i wp wp search-replace https://www.oceancsempebolt.hu http://localhost --allow-root
echo "exchanging oceancsempebolt.hu to localhost in db"
docker exec -i wp wp search-replace oceancsempebolt.hu localhost --allow-root
