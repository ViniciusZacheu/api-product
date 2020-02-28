#!/usr/bin/env sh

if [ "$APP_ENV" = "local" ]; then
    sed -i 's/^;//' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    echo "max_execution_time=300" >> /usr/local/etc/php/php.ini
    echo "xdebug.max_nesting_level=1000" >> /usr/local/etc/php/php.ini
    echo "opcache.enable=0" >> /usr/local/etc/php/php.ini
    echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/php.ini
    sed -i 's/^session\.save_handler.*$//g' /usr/local/etc/php/php.ini
    sed -i 's/^session\.save_path.*$//g' /usr/local/etc/php/php.ini
fi

# Workaround for php://stdout in php-fpm until 7.3
# See https://github.com/docker-library/php/issues/207
set -e

PIPE=/tmp/stdout

if ! [ -p $PIPE ]; then
    mkfifo $PIPE
    chmod 666 $PIPE
fi

tail -f $PIPE &

if [ "${1#-}" != "$1" ]; then
    set -- php-fpm "$@"
fi

exec "$@"
