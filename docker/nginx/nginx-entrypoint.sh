#!/usr/bin/env sh

if [ -f /etc/nginx/conf.d/application.template ]; then
    envsubst '\$NGINX_HOST \$PHP_FPM_HOST' < /etc/nginx/conf.d/application.template > /etc/nginx/conf.d/application.conf
fi

exec "$@"
