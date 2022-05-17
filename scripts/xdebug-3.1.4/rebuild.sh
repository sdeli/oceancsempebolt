cd /xdebug-3.1.4/;
phpize;
./configure ;
make ;
cp modules/xdebug.so $(find /usr/local/lib/php/extensions/ -regextype posix-egrep -regex ".*no-debug-non-zts-[0-9]+$") ;
cp /xdebug-3.1.4/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini ;
cp /xdebug-3.1.4/99-xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini ;