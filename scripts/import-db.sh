#!/bin/bash
MYSQL_ROOT_PASSWORD=$1
MYSQL_DATABASE=$2
SQL_FILE=$3

echo "This may take some time!"
docker exec -i mysql mysql -uroot -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < $SQL_FILE
# docker-compose exec -T mysql mysql -uuser -ppassword database_name < dir/to/db_backup.sql
