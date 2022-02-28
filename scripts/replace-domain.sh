#!/bin/bash
# it replaces these strings to 'http://localhost' in an sql file:
# 'oceancsempebolt.hu'
# https://oceancsempebolt.hu http://localhost
# http://oceancsempebolt.hu http://localhost
# http://www.oceancsempebolt.hu http://localhost
# https://www.oceancsempebolt.hu http://localhost

SQL_FILE_PATH=$1
DOMAIN=$2
BACKUP_SQL_FILE_PATH=$(echo $SQL_FILE_PATH | sed "s/.sql/.backup.sql/")
cat $1 > $BACKUP_SQL_FILE_PATH

cat << EOF
To replace urls to 'localhost' started, it will take some time!

if no bugs/errors were reported by script, and "${SQL_FILE_PATH}.sedback" got created, 
then check if the following exchanges have happened in: "$SQL_FILE_PATH"

https://${DOMAIN} => http://localhost
http://${DOMAIN} => http://localhost
http://www.${DOMAIN} => http://localhost
https://www.${DOMAIN} => http://localhost

EOF

LC_ALL=C sed -i '' "s/https:\/\/${DOMAIN}/http:\/\/localhost/g" $SQL_FILE_PATH
if [ $? -ne 0 ]; then exit 1; fi
LC_ALL=C sed -i '' "s/https:\/\/${DOMAIN}/http:\/\/localhost/g" $SQL_FILE_PATH
if [ $? -ne 0 ]; then exit 1; fi
LC_ALL=C sed -i '' "s/http:\/\/${DOMAIN}/http:\/\/localhost/g" $SQL_FILE_PATH
if [ $? -ne 0 ]; then exit 1; fi
LC_ALL=C sed -i '' "s/http:\/\/www.${DOMAIN}/http:\/\/localhost/g" $SQL_FILE_PATH
if [ $? -ne 0 ]; then exit 1; fi
LC_ALL=C sed -i '' "s/https:\/\/www.${DOMAIN}/http:\/\/localhost/g" $SQL_FILE_PATH
if [ $? -ne 0 ]; then exit 1; fi
LC_ALL=C sed -i '' "s/'${DOMAIN}'/'localhost'/g" $SQL_FILE_PATH
if [ $? -ne 0 ]; then exit 1; fi

echo "Looks like succesfully finished, but reather check the file: $SQL_FILE_PATH"
