FROM laravelphp/vapor:php83

COPY ./vapor-php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY . /var/task
