#!/usr/bin/env bash

if [[ -d "vendor" ]]
then
    composer update
else
    composer create-project drupal-composer/drupal-project:8.x-dev ./ --no-interaction
fi


ln -s web docroot

composer require wikimedia/composer-merge-plugin
composer config extra.merge-plugin.require '../test/composer.json'
composer update

mkdir docroot/modules/custom
cp -r ../test docroot/modules/custom/test_module

cp /var/www/test/.circleci/phpunit.xml docroot/core/phpunit.xml
cd docroot && ../vendor/bin/phpunit -c core modules/custom
