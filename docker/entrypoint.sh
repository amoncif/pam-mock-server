#!/bin/sh
set -eu
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console pam:fixtures:initialize
php bin/console assets:install public
php bin/console cache:clear
chown -R www-data:www-data var
exec "$@"
